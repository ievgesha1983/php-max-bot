<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Api\NewMessage;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;
use EvgeshaFactory\PhpMaxBot\Objects\Api\NewMessage\Body\Attachment;
use EvgeshaFactory\PhpMaxBot\Objects\Api\NewMessage\Body\Link;

class Body extends AbstractProcessor
{
    protected string|null $text;
    protected Attachment|null $attachment;
    protected Link|null $link;
    protected bool $notify = true;
    protected string|null $format;

    public function __construct(array $body)
    {
        foreach ($body as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = match ($key) {
                    'attachment' => new Attachment($value),
                    'link' => new Link($value),
                    default => $value,
                };
            }
        }
    }
}
