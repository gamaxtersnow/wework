<?php

namespace WeWork\Traits;

trait AppIdTrait
{
    /**
     * @var string
     */
    protected $appid;

    public function setAppId(string $appId): void
    {
        $this->appid = $appId;
    }
}
