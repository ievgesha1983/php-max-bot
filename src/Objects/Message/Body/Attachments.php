<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Message\Body;

use EvgeshaFactory\PhpMaxBot\Objects\Message\Body\Attachments\Payload;

class Attachments
{
    private string $type;
    private Payload $payload;

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
