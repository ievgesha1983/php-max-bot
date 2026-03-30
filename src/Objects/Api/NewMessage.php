<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Api;

use EvgeshaFactory\PhpMaxBot\Objects\Api\NewMessage\Body;

class NewMessage
{
    private int|false $userId = false;
    private int|false $chatId = false;
    private bool|null $disableLinkPreview = null;
    private Body|null $body = null;

    public function __construct(
        int|false $userId = false,
        int|false $chatId = false,
        bool|null $disableLinkPreview = null,
        array|null $body = null
    ) {
        $this->userId = $userId;
        $this->chatId = $chatId;
        $this->disableLinkPreview = $disableLinkPreview;
        $this->body = new Body($body);
    }

    public function getBody(): Body|null
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
