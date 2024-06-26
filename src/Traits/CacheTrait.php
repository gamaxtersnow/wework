<?php

namespace WeWork\Traits;

use Psr\SimpleCache\CacheInterface;

trait CacheTrait
{
    /**
     * @var CacheInterface
     */
    protected CacheInterface $cache;

    /**
     * @param CacheInterface $cache
     */
    public function setCache(CacheInterface $cache): void
    {
        $this->cache = $cache;
    }
}
