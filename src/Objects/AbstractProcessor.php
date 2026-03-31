<?php

namespace EvgeshaFactory\PhpMaxBot\Objects;

class AbstractProcessor
{
    public function switchCamelCaseToSnakeCase(string $string): string
    {
        return strtolower(preg_replace('#([a-z])([A-Z])#', '$1_$2', $string));
    }

    public function convertToMaxArray(): array
    {
        $convertedArray = array_map(
            fn ($child) => is_object($child) ? $this->$child->convertToMaxArray() : $child,
            get_object_vars($this)
        );

        $switchedKeys = array_map(
            fn ($key) => $this->switchCamelCaseToSnakeCase($key),
            array_keys($convertedArray)
        );

        return array_combine($switchedKeys, array_values($convertedArray));
    }

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
