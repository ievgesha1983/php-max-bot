<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Message\Body\Attachments;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;

class Payload extends AbstractProcessor
{
    protected int $photoId;
    protected string $token;
    protected string $url;

    public function __construct(array $payload)
    {
        foreach ($payload as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
