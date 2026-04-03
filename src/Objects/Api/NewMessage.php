<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Api;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;
use EvgeshaFactory\PhpMaxBot\Objects\Api\NewMessage\Body;

class NewMessage extends AbstractProcessor
{
    protected int $userId;
    protected int $chatId;
    protected bool $disableLinkPreview;
    protected Body $body;

    public function __construct(
        int|false $userId = false,
        int|false $chatId = false,
        bool|null $disableLinkPreview = null,
        array|false $body = false
    ) {
        if ($userId !== false) {
            $this->userId = $userId;
        }
        if ($chatId !== false) {
            $this->chatId = $chatId;
        }
        if (!is_null($disableLinkPreview)) {
            $this->disableLinkPreview = $disableLinkPreview;
        }
        if ($body !== false) {
            $this->body = new Body($body);
        }
    }

    public function getBody(): Body
    {
        return $this->body;
    }

    public function createGetParameters(): string
    {
        $parameters = '';
        if ($this->userId !== false) {
            $parameters = "{$parameters}&user_id={$this->userId}";
        }

        if ($this->chatId !== false) {
            $parameters = "{$parameters}&chat_id={$this->chatId}";
        }

        if ($this->disableLinkPreview !== null) {
            $parameters = "{$parameters}&disable_link_preview={$this->disableLinkPreview}";
        }

        if ($parameters !== '') {
            $parameters = '?' . substr($parameters, 1);
        }

        return $parameters;
    }

    public function createPostFields(): array
    {
        $postFields = [];

        return $postFields;
    }
}
