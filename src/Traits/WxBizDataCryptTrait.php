<?php

namespace WeWork\Traits;

use WeWork\Crypt\WXBizDataCrypt;

trait WxBizDataCryptTrait
{
    /**
     * @var WXBizDataCrypt
     */
    protected $wxBizDataCrypt;

    public function setWxBizDataCrypt(WXBizDataCrypt $wxBizDataCrypt): void
    {
        $this->wxBizDataCrypt = $wxBizDataCrypt;
    }
}
