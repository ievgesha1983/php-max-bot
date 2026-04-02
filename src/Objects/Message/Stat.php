<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Message;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;

class Stat extends AbstractProcessor
{
    protected int $views;

    public function __construct(array $stat)
    {
        foreach ($stat as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
