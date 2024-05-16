<?php
namespace WeWork\Crypt;

use WeWork\Traits\AppIdTrait;

class WXBizDataCrypt
{
    use AppIdTrait;

    /**
     * 构造函数
     * @param $appid string 小程序的appid
     */


    /**
     *  检验数据的真实性，并且获取解密后的明文.
     * @param string $sessionKey sessionKey
     * @param string $encryptedData 加密的用户数据
     * @param string $iv 与用户数据一同返回的初始向量
     * @return array 成功0，失败返回对应的错误码
     */
	public function decryptData(string $sessionKey,string $encryptedData, string $iv):array
	{
        $data = [];
		if (strlen($sessionKey) != 24) {
			return ['res'=>false,'msg'=>ErrorCode::getCodeMsg(ErrorCode::$IllegalAesKey),'data'=>$data];
		}
		$aesKey=base64_decode($sessionKey);

        
		if (strlen($iv) != 24) {
            return ['res'=>false,'msg'=>ErrorCode::getCodeMsg(ErrorCode::$IllegalIv),'data'=>$data];
		}
		$aesIV=base64_decode($iv);

		$aesCipher=base64_decode($encryptedData);

		$result=openssl_decrypt( $aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);

		$dataObj=json_decode( $result );
		if( $dataObj  == NULL )
		{
            return ['res'=>false,'msg'=>ErrorCode::getCodeMsg(ErrorCode::$IllegalBuffer),'data'=>$data];
		}
		if( $dataObj->watermark->appid != $this->appid )
		{
            return ['res'=>false,'msg'=>ErrorCode::getCodeMsg(ErrorCode::$IllegalBuffer),'data'=>$data];
		}
        return ['res'=>true,'msg'=>ErrorCode::getCodeMsg(ErrorCode::$OK),'data'=>json_decode($result,true)];
	}

}

