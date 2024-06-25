<?php

namespace WeWork\Api;

use Psr\Http\Message\StreamInterface;
use WeWork\Traits\HttpClientTrait;

class Media
{
    use HttpClientTrait;

    /**
     * 上传临时素材
     *
     * @param string $type
     * @param string $path
     * @return array
     */
    public function upload(string $type, string $path): array
    {
        return $this->httpClient->postFile('media/upload', $path, compact('type'));
    }

    /**
     * 获取临时素材
     *
     * @param string $id
     * @return StreamInterface
     */
    public function get(string $id): StreamInterface
    {
        return $this->httpClient->getStream('media/get', ['media_id' => $id]);
    }

    /**
     * 同步获取临时素材
     * @param string $id
     * @return StreamInterface
     */
    public function getSync(string $id): StreamInterface
    {
        return $this->httpClient->getStream('media/get', ['media_id' => $id],true);
    }

    /**
     * 获取高清语音素材
     *
     * @param string $id
     * @return StreamInterface
     */
    public function getVoice(string $id): StreamInterface
    {
        return $this->httpClient->getStream('media/get/jssdk', ['media_id' => $id]);
    }

    /**
     * 上传图片
     *
     * @param string $path
     * @return array
     */
    public function uploadImg(string $path): array
    {
        return $this->httpClient->postFile('media/uploadimg', $path);
    }

    /**
     *获取媒体文件名称
     *
     * @param string $id
     * @return string
     */
    public function getFilename(string $id): string
    {
        $headers =  $this->httpClient->getStreamHeader('media/get', ['media_id' => $id]);
        $contentDisposition = $headers['Content-disposition']??'';
        return trim(substr($contentDisposition[0], strrpos($contentDisposition[0], '=') + 1), '"');
    }
    public function getMediaNames(array $mediaIds): array {
        $urls = [];
        foreach ($mediaIds as $mediaId) {
            $urls[] = ['media/get',['media_id' => $mediaId]];
        }
        return $this->httpClient->getAsync($urls);
    }
}
