<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Message;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;

class Recipient extends AbstractProcessor
{
    protected ?int $chatId;
    protected string $chatType;
    protected ?int $userId;

    public function __construct(array $recipient)
    {
        foreach ($recipient as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function getChatType(): string
    {
        return $this->chatType;
    }
}
