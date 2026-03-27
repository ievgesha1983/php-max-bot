<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Update;

use EvgeshaFactory\PhpMaxBot\Objects\Update;
use EvgeshaFactory\PhpMaxBot\Objects\User;

class BotStarted extends Update
{
    protected int $chatId;
    protected User $user;
    protected string|null|false $payload = false;
    protected string|false $userLocale = false;

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
