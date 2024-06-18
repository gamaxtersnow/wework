<?php

namespace WeWork\Message;

class MPArticle implements ResponseMessageInterface
{
    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $thumbMediaId;

    /**
     * @var string
     */
    private string $author;

    /**
     * @var string
     */
    private string $contentSourceUrl;

    /**
     * @var string
     */
    private string $content;

    /**
     * @var string
     */
    private string $digest;

    /**
     * @param string $title
     * @param string $thumbMediaId
     * @param string $content
     * @param string $author
     * @param string $contentSourceUrl
     * @param string $digest
     */
    public function __construct(string $title, string $thumbMediaId, string $content, string $author = '', string $contentSourceUrl = '', string $digest = '')
    {
        $this->title = $title;
        $this->thumbMediaId = $thumbMediaId;
        $this->content = $content;
        $this->author = $author;
        $this->contentSourceUrl = $contentSourceUrl;
        $this->digest = $digest;
    }

    /**
     * @return array
     */
    public function formatForResponse(): array
    {
        return [
            'title' => $this->title,
            'thumb_media_id' => $this->thumbMediaId,
            'author' => $this->author,
            'content_source_url' => $this->contentSourceUrl,
            'content' => $this->content,
            'digest' => $this->digest
        ];
    }
}
