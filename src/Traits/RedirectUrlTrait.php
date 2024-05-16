<?php

namespace WeWork\Traits;

trait RedirectUrlTrait
{
    /**
     * @var string
     */
    protected $redirectUrl;

    /**
     * @param string $redirectUrl
     */
    public function setRedirectUrl(string $redirectUrl): void
    {
        $this->redirectUrl = $redirectUrl;
    }
}
