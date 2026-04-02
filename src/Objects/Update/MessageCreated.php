<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Update;

use EvgeshaFactory\PhpMaxBot\Objects\Message;
use EvgeshaFactory\PhpMaxBot\Objects\Update;

class MessageCreated extends Update
{
    protected Message $message;
    protected ?string $userLocale;

    public function __construct(array $update)
    {
        parent::__construct($update['updateType'], $update['timestamp']);
        foreach ($update as $key => $value) {
            if (property_exists($this, $key) && $key !== 'updateType' && $key !== 'timestamp') {
                $this->$key = match ($key) {
                    'message' => new Message($value),
                    default => $value,
                };
            }
        }
    }
}
