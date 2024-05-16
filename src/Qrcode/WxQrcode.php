<?php
namespace WeWork\Qrcode;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
use WeWork\Traits\AuthUrlTrait;
use WeWork\Traits\QrcodeTrait;
use WeWork\Traits\RedirectUrlTrait;
use WeWork\Traits\AgentIdTrait;
use WeWork\Traits\CorpIdTrait;
use WeWork\Traits\SecretTrait;

class WxQrcode {
    use QrcodeTrait,CorpIdTrait, SecretTrait,AgentIdTrait,AuthUrlTrait,RedirectUrlTrait;
    public function getLoginQrCode(string $state): WxQrcode
    {
        $text = $this->authUrl.'?appid='.$this->corpId.'&redirect_uri='.$this->redirectUrl.'&response_type=code&scope=snsapi_privateinfo&state='.$state.'&agentid='.$this->agentId.'&connect_redirect=1#wechat_redirect';
        $this->qrcodeClient->setText($text);
        return $this;

    }

    public function getQrcodeClient(): QrCode{
        return $this->qrcodeClient;
    }
    public function toBase64(): string {
        $response = new QrCodeResponse($this->qrcodeClient);
        return 'data:png;base64,' . base64_encode($response->getContent());

    }
    public function send(){
        $response = new QrCodeResponse($this->qrcodeClient);
        $response->send();
    }

}