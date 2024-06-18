<?php

namespace WeWork\Traits;

trait AppIdTrait
{
    /**
     * @var string
     */
    protected string $appid;

    public function setAppId(string $appId): void
    {
        $this->appid = $appId;
    }
}
