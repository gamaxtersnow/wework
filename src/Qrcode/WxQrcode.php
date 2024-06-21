<?php
namespace WeWork\Qrcode;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use WeWork\Traits\QrcodeTrait;

class WxQrcode {
    use QrcodeTrait;
    public PngWriter $pngWriter;
    public function __construct()
    {
        $this->pngWriter = new PngWriter();
    }

    public function getQrCode(string $content): WxQrcode
    {
        $this->qrcodeClient->setData($content);
        $this->qrcodeClient->setMargin(0);
        return $this;
    }

    public function getQrcodeClient(): QrCode{
        return $this->qrcodeClient;
    }
    public function toBase64(): string {
        return   $this->pngWriter->write($this->qrcodeClient)->getDataUri();
    }
    public function saveToFile(string $filePath): void
    {
        $this->pngWriter->write($this->qrcodeClient)->saveToFile($filePath);
    }
}