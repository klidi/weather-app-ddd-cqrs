<?php

namespace App\Weather\Partner\Infrastructure\Repository;

use App\Weather\Partner\Domain\PartnerRepository;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

abstract class AbstractPartnerRepository implements PartnerRepository
{
    public function __construct(private FilesystemAdapter $cache)
    {}

    abstract protected function cacheKey() : string;

    /**
     * @throws InvalidArgumentException
     */
    protected function getCache() : \Iterator
    {
        $data = [];

        if ($this->hasCache()) {
            $item = $this->cache->getItem($this->cacheKey());
            $data = $item->get();
        }

        return new \ArrayIterator($data);
    }

    /**
     * @throws InvalidArgumentException
     */
    protected function hasCache() : bool
    {
        return $this->cache->hasItem($this->cacheKey());
    }

    /**
     * @throws InvalidArgumentException
     */
    protected function setCache(\Iterator $data) : void
    {
        $item = $this->cache->getItem($this->cacheKey());
        $item->set($data);
        $item->expiresAfter(60);
        $this->cache->save($item);
    }
}