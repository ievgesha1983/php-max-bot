<?php

namespace EvgeshaFactory\PhpMaxBot;

use EvgeshaFactory\PhpMaxBot\Objects\AbstractProcessor;
use EvgeshaFactory\PhpMaxBot\Objects\Api\NewSubscription;
use EvgeshaFactory\PhpMaxBot\Objects\Bot\Command;

class Bot extends AbstractProcessor
{
    protected int $userId;
    protected string $firstName;
    protected string $name;
    protected string $username;
    protected bool $isBot = true;
    protected int $lastActivityTime;
    protected string|false $description = false;
    protected string|false $avatarUrl = false;
    protected string|false $fullAvatarUrl = false;
    protected Command|false $command = false;
    private ApiGateway $api;

    public function __construct(string $token)
    {
        $this->api = new ApiGateway($token);
    }

    public function getBotInfo(): Bot
    {
        $botInfo = $this->api->getBotInfo();
        $responseProcessor = new ResponseProcessor();
        $decodedBotInfo = $responseProcessor->decodeBotInfo($botInfo);
        foreach ($decodedBotInfo as $key => $value) {
            if (property_exists($this, $key)) {
                if ($key !== 'token') {
                    $this->$key = $value;
                }
            }
        }
        return $this;
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

    public function sendMessage($message): array
    {
        $sendMessagesResponse = $this->api->sendMessage($message);
        $responseProcessor = new ResponseProcessor();
        return $responseProcessor->decodeSendMessage($sendMessagesResponse);
    }

    public function getSubscriptions(): array
    {
        $subscriptions = $this->api->getSubscriptions();
        $responseProcessor = new ResponseProcessor();
        return $responseProcessor->decodeGetSubscriptions($subscriptions);
    }

    public function subscribeToUpdates(NewSubscription $newSubscription): array
    {
        $response = $this->api->subscribeToUpdates($newSubscription);
        $responseProcessor = new ResponseProcessor();
        return $responseProcessor->decodeSubscribeToUpdates($response);
    }

    public function unsubscribeFromUpdates(string $url): array
    {
        $response = $this->api->unsubscribeFromUpdates($url);
        $responseProcessor = new ResponseProcessor();
        return $responseProcessor->decodeUnsubscribeFromUpdates($response);
    }
}
