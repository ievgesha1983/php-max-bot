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
        int|false $userIdIntermediate = false,
        int|false $chatIdIntermediate = false,
        bool|null $disableLinkPreviewIntermediate = null,
        array|false $bodyIntermediate = false
    ) {
        if ($userIdIntermediate !== false) {
            $this->userId = $userIdIntermediate;
        }
        if ($chatIdIntermediate !== false) {
            $this->chatId = $chatIdIntermediate;
        }
        if (!is_null($disableLinkPreviewIntermediate)) {
            $this->disableLinkPreview = $disableLinkPreviewIntermediate;
        }
        if ($bodyIntermediate !== false) {
            $this->body = new Body($bodyIntermediate);
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
