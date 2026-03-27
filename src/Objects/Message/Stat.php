<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Message;

class Stat
{
    private int $views;

    public function __construct(array $stat)
    {
        foreach ($stat as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
