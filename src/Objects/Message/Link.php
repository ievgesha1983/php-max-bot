<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Message;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;
use EvgeshaFactory\PhpMaxBot\Objects\User;

class Link extends AbstractProcessor
{
    protected string $type;
    protected User $sender;
    protected int $chatId;
    protected Body $message;

    public function __construct(array $link)
    {
        foreach ($link as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = match ($key) {
                    'message' => new Body($value),
                    'sender' => new User($value),
                    default => $value,
                };
            }
        }
    }
}
