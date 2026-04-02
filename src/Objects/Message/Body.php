<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Message;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;
use EvgeshaFactory\PhpMaxBot\Objects\Message\Body\Attachments;
use EvgeshaFactory\PhpMaxBot\Objects\Message\Body\Markup;

class Body extends AbstractProcessor
{
    protected string $mid;
    protected int $seq;
    protected ?string $text;
    protected ?Attachments $attachments;
    protected ?Markup $markup;

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
