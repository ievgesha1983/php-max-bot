<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Api\NewMessage\Body;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;

class Link extends AbstractProcessor
{
    protected string $type;
    protected string $mid;

    public function __construct(array $link)
    {
        foreach ($link as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
