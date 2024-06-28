<?php

namespace WeWork\Message;

class MarkDown implements ResponseMessageInterface, ReplyMessageInterface
{
    /**
     * @var string
     */
    private string $content;

    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function formatForReply(): array
    {
        return [
            'MsgType' => 'markdown',
            'MarkDown' => [
                'Content' => $this->content
            ]
        ];
    }

    /**
     * @return array
     */
    public function formatForResponse(): array
    {
        return [
            'msgtype' => 'markdown',
            'markdown' => [
                'content' => $this->content
            ]
        ];
    }
}
