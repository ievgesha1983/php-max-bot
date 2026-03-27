<?php

namespace EvgeshaFactory\PhpMaxBot\Objects;

use EvgeshaFactory\PhpMaxBot\Objects\Message\Body;
use EvgeshaFactory\PhpMaxBot\Objects\Message\Link;
use EvgeshaFactory\PhpMaxBot\Objects\Message\Recipient;
use EvgeshaFactory\PhpMaxBot\Objects\Message\Stat;

class Message
{
    private Recipient $recipient;
    private int $timestamp;
    private Body $body;
    private User|false $sender = false;
    private Link|null|false $link = false;
    private Stat|null|false $stat = false;
    private string|null|false $url = false;

    public function __construct(array $message)
    {
        foreach ($message as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = match ($key) {
                    'recipient' => new Recipient($value),
                    'body' => new Body($value),
                    'sender' => new User($value),
                    'link' => new Link($value),
                    'stat' => new Stat($value),
                    default => $value,
                };
            }
        }
    }
}
