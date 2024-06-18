<?php

namespace WeWork\ApiCache;

use Psr\SimpleCache\InvalidArgumentException;
use WeWork\Traits\CacheTrait;

abstract class AbstractApiCache
{
    use CacheTrait;

    /**
     * @return string
     */
    abstract protected function getCacheKey(): string;

    /**
     * @return string
     */
    abstract protected function getFromServer(): string;

    /**
     * @param bool $refresh
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function get(bool $refresh = false): mixed
    {
        $key = $this->getCacheKey();

        $value = $this->cache->get($key);

        if ($refresh || !$value) {
            $value = $this->getFromServer();
            $this->cache->set($key, $value, 7100);
        }

        return $value;
    }
}
