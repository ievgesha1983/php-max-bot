<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Api\NewMessage;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;
use EvgeshaFactory\PhpMaxBot\Objects\Api\NewMessage\Body\Attachment;
use EvgeshaFactory\PhpMaxBot\Objects\Api\NewMessage\Body\Link;

class Body extends AbstractProcessor
{
    protected ?string $text;
    protected ?Attachment $attachment;
    protected ?Link $link;
    protected bool $notify = true;
    protected ?string $format;

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
