<?php

namespace EvgeshaFactory\PhpMaxBot\Objects\Api;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;

class NewSubscription extends AbstractProcessor
{
    protected string $url;
    protected array $updateTypes;
    protected string $secret;

    public function __construct(string $url, array|false $updateTypes = false, string|false $secret = false)
    {
        $this->url = $url;
        if ($updateTypes !== false) {
            $this->updateTypes = $updateTypes;
        }
        if ($secret !== false) {
            $this->secret = $secret;
        }
    }
}
