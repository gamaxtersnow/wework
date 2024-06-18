<?php

namespace WeWork\Message;

class TextCard implements ResponseMessageInterface
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
    private string $btnTxt;

    /**
     * @param string $title
     * @param string $description
     * @param string $url
     * @param string $btnTxt
     */
    public function __construct(string $title, string $description, string $url, string $btnTxt = '')
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->btnTxt = $btnTxt;
    }

    /**
     * @return array
     */
    public function formatForResponse(): array
    {
        return [
            'msgtype' => 'textcard',
            'textcard' => [
                'title' => $this->title,
                'description' => $this->description,
                'url' => $this->url,
                'btntxt' => $this->btnTxt
            ]
        ];
    }
}
