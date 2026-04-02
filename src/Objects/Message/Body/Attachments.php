<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Message\Body;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;
use EvgeshaFactory\PhpMaxBot\Objects\Message\Body\Attachments\Payload;

class Attachments extends AbstractProcessor
{
    protected string $type;
    protected Payload $payload;

    public function __construct(array $attachments)
    {
        foreach ($attachments as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = match ($key) {
                    'payload' => new Payload($value),
                    default => $value,
                };
            }
        }
    }
}
