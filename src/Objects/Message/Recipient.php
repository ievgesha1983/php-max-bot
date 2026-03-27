<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Message;

class Recipient
{
    private ?int $chatId;
    private string $chatType;
    private ?int $userId = null;

    public function __construct(array $recipient)
    {
        foreach ($recipient as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
