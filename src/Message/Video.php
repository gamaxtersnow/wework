<?php

namespace WeWork\Message;

class Video implements ResponseMessageInterface, ReplyMessageInterface
{
    /**
     * @var string
     */
    private string $mediaId;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $description;

    /**
     * @param string $mediaId
     * @param string $title
     * @param string $description
     */
    public function __construct(string $mediaId, string $title = '', string $description = '')
    {
        $this->mediaId = $mediaId;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function formatForReply(): array
    {
        return [
            'MsgType' => 'video',
            'Video' => [
                'MediaId' => $this->mediaId,
                'Title' => $this->title,
                'Description' => $this->description
            ]
        ];
    }

    /**
     * @return array
     */
    public function formatForResponse(): array
    {
        return [
            'msgtype' => 'video',
            'video' => [
                'media_id' => $this->mediaId,
                'title' => $this->title,
                'description' => $this->description
            ]
        ];
    }
}
