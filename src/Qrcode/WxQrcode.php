<?php
namespace WeWork\Qrcode;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use WeWork\Traits\AuthUrlTrait;
use WeWork\Traits\QrcodeTrait;
use WeWork\Traits\RedirectUrlTrait;
use WeWork\Traits\AgentIdTrait;
use WeWork\Traits\CorpIdTrait;
use WeWork\Traits\SecretTrait;

class WxQrcode {
    use QrcodeTrait,CorpIdTrait, SecretTrait,AgentIdTrait,AuthUrlTrait,RedirectUrlTrait;
    public PngWriter $pngWriter;
    public function __construct()
    {
        $this->pngWriter = new PngWriter();
    }

    public function getLoginQrCode(string $state): WxQrcode
    {
        $text = $this->authUrl.'?appid='.$this->corpId.'&redirect_uri='.$this->redirectUrl.'&response_type=code&scope=snsapi_privateinfo&state='.$state.'&agentid='.$this->agentId.'&connect_redirect=1#wechat_redirect';
        $this->qrcodeClient->setData($text);
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