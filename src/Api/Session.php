<?php

namespace WeWork\Api;

use WeWork\Traits\WxBizDataCryptTrait;
use WeWork\Traits\HttpClientTrait;

class Session
{

    use HttpClientTrait,WxBizDataCryptTrait;

    public function code2session(string $code): array
    {
        $query = [
            'js_code' => $code,
            'grant_type' => 'authorization_code',
        ];
        return $this->httpClient->get('miniprogram/jscode2session', $query);
    }
    public function decryptUserEmail(string $sessionKey,string $encryptedData, string $iv):array {
        return $this->wxBizDataCrypt->decryptData($sessionKey,$encryptedData,$iv);
    }
}