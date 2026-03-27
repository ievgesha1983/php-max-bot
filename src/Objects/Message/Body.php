<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Message;

use EvgeshaFactory\PhpMaxBot\Objects\Message\Body\Attachments;
use EvgeshaFactory\PhpMaxBot\Objects\Message\Body\Markup;

class Body
{
    private string $mid;
    private int $seq;
    private string|null $text;
    private Attachments|null|false $attachments = false;
    private Markup|null|false $markup = false;

    public function __construct(array $body)
    {
        foreach ($body as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = match ($key) {
                    'attachments' => new Attachments($value),
                    'markup' => new Markup($value),
                    default => $value,
                };
            }
        }
    }
}
