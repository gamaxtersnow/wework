<?php

namespace WeWork\Traits;

trait AuthUrlTrait
{
    /**
     * @var string
     */
    protected $authUrl;

    /**
     * @param string $authUrl
     */
    public function setAuthUrl(string $authUrl): void
    {
        $this->authUrl = $authUrl;
    }
}