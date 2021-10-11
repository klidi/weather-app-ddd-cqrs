<?php

declare(strict_types=1);

namespace App\Weather\Partner\Infrastructure\Repository\FileReader;

trait JsonReaderTrait
{
    protected function read(string $path) : \Iterator
    {
        // I would have used flysystem but just to save time im cutting things short
        $json = file_get_contents($path);

        return new \ArrayIterator(json_decode($json, true));
    }
}