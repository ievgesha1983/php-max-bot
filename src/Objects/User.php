<?php

namespace EvgeshaFactory\PhpMaxBot\Objects;

class User
{
    private int $userId;
    private string $firstName;
    private bool $isBot;
    private int $lastActivityTime;
    private string|null|false $lastName = false;
    private string|null|false $username = false;

    /*
     * Устаревшее поле, скоро будет удалено
     */
    private string|null|false $name = false;

    public function __construct(array $user)
    {
        foreach ($user as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
