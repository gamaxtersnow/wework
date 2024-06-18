<?php

namespace WeWork\Message;

class Article implements ResponseMessageInterface, ReplyMessageInterface
{
    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var string
     */
    private string $url;

    /**
     * @var string
     */
    private string $picUrl;

    /**
     * @var string
     */
    private string $btnTxt;

    /**
     * @param string $title
     * @param string $url
     * @param string $description
     * @param string $picUrl
     * @param string $btnTxt
     */
    public function __construct(string $title, string $url, string $description = '', string $picUrl = '', string $btnTxt = '')
    {
        $this->title = $title;
        $this->url = $url;
        $this->description = $description;
        $this->picUrl = $picUrl;
        $this->btnTxt = $btnTxt;
    }

    /**
     * @return array
     */
    public function formatForReply(): array
    {
        return [
            'Title' => $this->title,
            'Description' => $this->description,
            'PicUrl' => $this->picUrl,
            'Url' => $this->url
        ];
    }

    /**
     * @return array
     */
    public function formatForResponse(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'picurl' => $this->picUrl,
            'btntxt' => $this->btnTxt
        ];
    }
}
