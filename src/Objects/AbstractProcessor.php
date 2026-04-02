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
        $children = get_object_vars($this);
        $convertedChildren = [];
        foreach ($children as $key => $value) {
            $convertedChildren[$key] = is_object($value) ? $this->$key->convertToMaxArray() : $value;
        };

        $switchedKeys = array_map(
            fn ($key) => $this->switchCamelCaseToSnakeCase($key),
            array_keys($convertedChildren)
        );

        return array_combine($switchedKeys, array_values($convertedChildren));
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
