<?php

namespace WeWork\Traits;

use WeWork\Crypt\WXBizDataCrypt;

trait WxBizDataCryptTrait
{
    /**
     * @var WXBizDataCrypt
     */
    protected WXBizDataCrypt $wxBizDataCrypt;

    public function setWxBizDataCrypt(WXBizDataCrypt $wxBizDataCrypt): void
    {
        $this->wxBizDataCrypt = $wxBizDataCrypt;
    }
}
