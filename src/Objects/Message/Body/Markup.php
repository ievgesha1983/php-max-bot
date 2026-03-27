<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Message\Body;

class Markup
{
    private string $type;
    private string $from;
    private string $length;

    public function __construct(array $markup)
    {
        foreach ($markup as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
