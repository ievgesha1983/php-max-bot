<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Message;

use EvgeshaFactory\PhpMaxBot\Objects\User;

class Link
{
    private string $type;
    private Body $message;
    private User|null|false $sender = false;
    private int|false $chatId = false;

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
