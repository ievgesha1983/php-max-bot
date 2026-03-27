<?php

namespace EvgeshaFactory\PhpMaxBot;

use EvgeshaFactory\PhpMaxBot\Objects\Bot\Command;

class Bot
{
    private string $token;
    private int $userId;
    private string $firstName;
    private string $name;
    private string $username;
    private bool $isBot = true;
    private int $lastActivityTime;
    private string|false $description = false;
    private string|false $avatarUrl = false;
    private string|false $fullAvatarUrl = false;
    private Command|false $command = false;
    private ApiGateway $api;

    public function __construct(string $token)
    {
        $this->token = $token;
        $this->api = new ApiGateway($this);
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getBotInfo(): Bot
    {
        $botInfo = $this->api->getBotInfo();
        $responseProcessor = new ResponseProcessor();
        return $responseProcessor->decodeBotInfo($botInfo);
    }

    public function getUpdates(
        int|false $limit = false,
        int|false $timeout = false,
        int|false|null $marker = false,
        string|false|null $types = false
    ): array {
        $updates = $this->api->getUpdates($limit, $timeout, $marker, $types);
        $responseProcessor = new ResponseProcessor();
        return $responseProcessor->decodeUpdates($updates);
    }

    /**
     * Не выдает сообщение, если получены несуществующие поля. Не создает новые поля.
     */
    public function updateBotInfo(): void
    {
        $responseProcessor = new ResponseProcessor();
        $botInfo = $responseProcessor->decodeBotInfo($this->api->getBotInfo());
        foreach ($botInfo as $name => $value) {
            if (property_exists($this, $name) && $name !== 'token') {
                $this->$name = $value;
            }
        }
    }
}
