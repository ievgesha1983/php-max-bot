<?php

namespace EvgeshaFactory\PhpMaxBot\Objects;

class Subscription
{
    protected string $url;
    protected int $time;
    protected array|null $updateTypes;

    public function __construct(array $subscription)
    {
        foreach ($subscription as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}
