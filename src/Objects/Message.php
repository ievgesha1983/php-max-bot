<?php

namespace EvgeshaFactory\PhpMaxBot\Objects;

use EvgeshaFactory\PhpMaxBot\Objects\Message\Body;
use EvgeshaFactory\PhpMaxBot\Objects\Message\Link;
use EvgeshaFactory\PhpMaxBot\Objects\Message\Recipient;
use EvgeshaFactory\PhpMaxBot\Objects\Message\Stat;

class Message extends AbstractProcessor
{
    protected User $sender;
    protected Recipient $recipient;
    protected int $timestamp;
    protected ?Link $link;
    protected Body $body;
    protected ?Stat $stat;
    protected ?string $url;

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
