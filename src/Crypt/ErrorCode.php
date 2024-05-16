<?php
    namespace WeWork\Crypt;
/**
 * error code 说明.
 * <ul>
 *      <li>-40001: 签名验证错误</li>
 *      <li>-40002: xml解析失败</li>
 *      <li>-40003: sha加密生成签名失败</li>
 *      <li>-40004: encodingAesKey 非法</li>
 *      <li>-40005: corpid 校验错误</li>
 *      <li>-40006: aes 加密失败</li>
 *      <li>-40007: aes 解密失败</li>
 *      <li>-40008: 解密后得到的buffer非法</li>
 *      <li>-40009: base64加密失败</li>
 *      <li>-40010: base64解密失败</li>
 *      <li>-40011: 生成xml失败</li>
 *      <li>-41001: encodingAesKey 非法</li>
 *      <li>-41003: aes 解密失败</li>
 *      <li>-41004: 解密后得到的buffer非法</li>
 *      <li>-41005: base64加密失败</li>
 *      <li>-41016: base64解密失败</li>
 * </ul>
 *
 *
 *
 */
class ErrorCode
{
	public static $OK = 0;
	public static $IllegalAesKey = -41001;
	public static $IllegalIv = -41002;
	public static $IllegalBuffer = -41003;
	public static $DecodeBase64Error = -41004;
    public static $ValidateSignatureError = -40001;
    public static $ParseXmlError = -40002;
    public static $ComputeSignatureError = -40003;
    public static $ValidateCorpidError = -40005;
    public static $EncryptAESError = -40006;
    public static $DecryptAESError = -40007;
    public static $EncodeBase64Error = -40009;
    public static $GenReturnXmlError = -40011;

    public static function getCodeMsg(int $code):string {
        return [
            self::$OK => 'OK',
            self::$IllegalAesKey => 'encodingAesKey 非法',
            self::$IllegalIv => 'Illegal Iv',
            self::$IllegalBuffer => 'aes 解密失败',
            self::$DecodeBase64Error => '解密后得到的buffer非法'
        ][$code];
    }
 }