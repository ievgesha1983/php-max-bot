<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Message\Body;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;

class Markup extends AbstractProcessor
{
    protected string $type;
    protected string $from;
    protected string $length;

    public function __construct(array $markup)
    {
        foreach ($markup as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
