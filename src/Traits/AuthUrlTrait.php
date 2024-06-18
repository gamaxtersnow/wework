<?php

namespace WeWork\Traits;

trait AuthUrlTrait
{
    /**
     * @var string
     */
    protected string $authUrl;

    /**
     * @param string $authUrl
     */
    public function setAuthUrl(string $authUrl): void
    {
        $this->authUrl = $authUrl;
    }
}