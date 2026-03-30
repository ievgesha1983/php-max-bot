<?php

namespace EvgeshaFactory\PhpMaxBot;

use EvgeshaFactory\PhpMaxBot\Objects\Api\NewMessage;
use EvgeshaFactory\PhpMaxBot\Objects\Message;

class ApiGateway
{
    private const string API_MAX = "https://platform-api.max.ru";
    private const string API_ME = "/me";
    private const string API_CHATS = "/chats";
    private const string API_UPDATES = "/updates";
    private const string API_MESSAGES = "/messages";
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getBotInfo(): string
    {
        $curl = curl_init(self::API_MAX . self::API_ME);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = [
            "Authorization: {$this->token}"
        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);

        return $response;
    }

    public function getUpdates(
        int|false $limit = false,
        int|false $timeout = false,
        int|false|null $marker = false,
        string|false|null $types = false
    ): string {
        $headers = [
            "Authorization: {$this->token}"
        ];

        $parameters = '';
        if ($limit !== false) {
            if ($limit < 1) {
                $limit = 1;
            }

            if ($limit > 1000) {
                $limit = 1000;
            }

            $parameters = "{$parameters}&limit={$limit}";
        }

        if ($timeout !== false) {
            if ($timeout < 0) {
                $timeout = 0;
            }

            if ($timeout > 90) {
                $timeout = 90;
            }

            $parameters = "{$parameters}&timeout={$timeout}";
        }

        if ($marker !== false) {
            $parameters = "{$parameters}&marker={$marker}";
        }

        if ($types !== false) {
            $parameters = "{$parameters}&types={$types}";
        }

        if ($parameters !== '') {
            $parameters = '?' . substr($parameters, 1);
        }

        $curl = curl_init(self::API_MAX . self::API_UPDATES . $parameters);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);

        return $response;
    }

    public function sendMessage(
        NewMessage $newMessage,
    ): string {
        $headers = [
            "Authorization: {$this->token}",
            "Content-Type: application/json"
        ];
        $postFields = json_encode($newMessage->getBody()->convertToArray());

        $curl = curl_init(self::API_MAX . self::API_MESSAGES . $newMessage->createGetParameters());
        curl_setopt($curl, CURLOPT_POSTFIELDS, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields);

        $response = curl_exec($curl);

        return $response;
    }
}
