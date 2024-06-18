<?php

namespace WeWork\Traits;

trait SecretTrait
{
    /**
     * @var string
     */
    protected string $secret;

    /**
     * @param string $secret
     */
    public function setSecret(string $secret): void
    {
        $this->secret = $secret;
    }

}
