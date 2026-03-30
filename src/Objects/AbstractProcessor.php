<?php

namespace EvgeshaFactory\PhpMaxBot\Objects;

class AbstractProcessor
{
    public function convertToArray(): array
    {
        $converted = [];
        foreach (get_object_vars($this) as $key => $value) {
            if (is_object($value)) {
                $converted[$key] = $value->convertToArray();
            } else {
                $converted[$key] = $value;
            }
        }
        return $converted;
    }
}
