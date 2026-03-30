<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Api\NewMessage\Body;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;

class Attachment extends AbstractProcessor
{
    protected string $type;
    //Payload надо будет сделать классы, для вложений.
    protected mixed $payload;

    public function __construct(array $attachment)
    {
        foreach ($attachment as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
