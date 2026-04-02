<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Bot;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;

class Command extends AbstractProcessor
{
    protected string $name;
    protected ?string $description;
}
