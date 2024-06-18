<?php

namespace WeWork\Traits;


use Endroid\QrCode\QrCode;

trait QrcodeTrait
{
    /**
     * @var QrCode
     */
    protected QrCode $qrcodeClient;

    /**
     * @param QrCode $qrcodeClient
     */
    public function setQrCodeClient(QrCode $qrcodeClient): void
    {
        $this->qrcodeClient = $qrcodeClient;
    }
}
