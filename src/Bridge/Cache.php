<?php

namespace WeWork\Bridge;


use Psr\SimpleCache\CacheInterface;

class Cache implements CacheInterface
{
    public function get($key, $default = null): mixed
    {
        return \think\facade\Cache::get($key, $default);
    }

    public function set($key, $value, $ttl = null): bool
    {
        \think\facade\Cache::set($key, $value, $ttl);
    }

    public function delete($key): bool
    {
        \think\facade\Cache::delete($key);
    }

    public function clear(): bool
    {
        \think\facade\Cache::clear();
    }

    public function getMultiple($keys, $default = null): iterable
    {
        \think\facade\Cache::getMultiple($keys, $default);
    }

    public function setMultiple($values, $ttl = null): bool
    {
        \think\facade\Cache::setMultiple($values, $ttl);
    }

    public function deleteMultiple($keys): bool
    {
        \think\facade\Cache::deleteMultiple($keys);
    }

    public function has($key): bool
    {
        return \think\facade\Cache::has($key);
    }
}

