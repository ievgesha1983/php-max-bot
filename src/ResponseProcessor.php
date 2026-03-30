<?php

namespace EvgeshaFactory\PhpMaxBot;

use EvgeshaFactory\PhpMaxBot\Objects\Update\BotAdded;
use EvgeshaFactory\PhpMaxBot\Objects\Update\BotRemoved;
use EvgeshaFactory\PhpMaxBot\Objects\Update\BotStarted;
use EvgeshaFactory\PhpMaxBot\Objects\Update\BotStopped;
use EvgeshaFactory\PhpMaxBot\Objects\Update\MessageCreated;

class ResponseProcessor
{
    public function switchSnakeCaseToCamelCase(string $string, bool $firstLow = true): string
    {
        $snakeCaseWords = explode('_', $string);
        $camelCaseWords = array_map('ucfirst', $snakeCaseWords);
        $camelCase = implode('', $camelCaseWords);

        return $firstLow ? lcfirst($camelCase) : $camelCase;
    }

    public function switchCamelCaseToSnakeCase(string $string): string
    {
        return strtolower(preg_replace('#([A-Z])#', '_$1', $string));
    }

    public function switchKeysToCamelCase(array $response): array
    {
        $replacedKeysInChildren = array_map(
            fn ($child) => is_array($child) ? $this->switchKeysToCamelCase($child) : $child,
            $response
        );
        $keys = array_keys($replacedKeysInChildren);
        $values = array_values($replacedKeysInChildren);
        $switchedKeys = array_map(
            fn($key) => $this->switchSnakeCaseToCamelCase($key),
            $keys
        );
        return array_combine($switchedKeys, $values);
    }

    public function decodeJson(string $response): array
    {
        $decodedResponse = json_decode($response, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $this->switchKeysToCamelCase($decodedResponse);
        }

        return ['Error' => 'Произошла ошибка декодировки JSON'];
    }

    public function decodeBotInfo(string $response): array|null
    {
        return $this->decodeJson($response);
    }

    public function decodeUpdates(string $response): array
    {
        $responseUpdates = $this->decodeJson($response);
        $updates['updates'] = array_map(
            function ($update) {
                $newUpdate = $this->createUpdate($update);
                return $newUpdate;
            },
            $responseUpdates['updates']
        );
        foreach ($responseUpdates as $key => $value) {
            if ($key !== 'updates') {
                $updates[$key] = $value;
            }
        }

        return $updates;
    }

    public function decodeSendMessage(string $response): array
    {
        $responseUpdates = $this->decodeJson($response);

        return $responseUpdates;
    }

    public function createUpdate(array $update): mixed
    {
        return match ($update['updateType']) {
            'message_created' => new MessageCreated($update),
            'bot_added' => new BotAdded($update),
            'bot_removed' => new BotRemoved($update),
            'bot_started' => new BotStarted($update),
            'bot_stopped' => new BotStopped($update),
            default => ['Error' => "Класс {$update['updateType']} не распознан"],
        };
    }
}
