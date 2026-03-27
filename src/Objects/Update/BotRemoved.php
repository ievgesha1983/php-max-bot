<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Update;

use EvgeshaFactory\PhpMaxBot\Objects\Update;
use EvgeshaFactory\PhpMaxBot\Objects\User;

class BotRemoved extends Update
{
    protected int $chatId;
    protected User $user;
    protected bool $isChannel;

    public function __construct(array $update)
    {
        parent::__construct($update['updateType'], $update['timestamp']);
        foreach ($update as $key => $value) {
            if (property_exists($this, $key) && $key !== 'updateType' && $key !== 'timestamp') {
                $this->$key = match ($key) {
                    'user' => new User($value),
                    default => $value,
                };
            }
        }
    }
}
