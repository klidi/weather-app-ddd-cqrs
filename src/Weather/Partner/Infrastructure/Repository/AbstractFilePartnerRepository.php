<?php


namespace App\Weather\Partner\Infrastructure\Repository;


use Psr\Cache\InvalidArgumentException;

abstract class AbstractFilePartnerRepository extends AbstractPartnerRepository
{
    abstract protected function read(string $path) : \Iterator;
    abstract protected function filePath() : string;

    /**
     * @throws InvalidArgumentException
     */
    protected function getRawPredictions(): \Iterator
    {
        if (!$this->hasCache()) {
            $data = $this->read($this->filePath());
            $this->setCache($data);

            return $data;
        }

        return $this->getCache();
    }
}