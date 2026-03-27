<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Message\Body\Attachments;

class Payload
{
    private int $photoId;
    private string $token;
    private string $url;

    public function __construct(array $payload)
    {
        foreach ($payload as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
