<?php

namespace EvgeshaFactory\PhpMaxBot\Objects;

abstract class Update
{
    protected string $updateType;
    protected int $timestamp;

    public function __construct(string $updateType, int $timestamp)
    {
        $this->updateType = $updateType;
        $this->timestamp = $timestamp;
    }
}
