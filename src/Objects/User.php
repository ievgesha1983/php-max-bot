<?php

namespace EvgeshaFactory\PhpMaxBot\Objects;

class User extends AbstractProcessor
{
    protected int $userId;
    protected string $firstName;
    protected ?string $lastName;
    protected ?string $username;
    protected bool $isBot;
    protected int $lastActivityTime;

    /*
     * Устаревшее поле, скоро будет удалено
     */
    protected ?string $name;

    public function __construct(array $user)
    {
        foreach ($user as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
