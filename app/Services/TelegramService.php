<?php

namespace App\Services;

use App\Telegram\Telegram;

class TelegramService implements TelegramServiceInterface
{
    protected object $telegram;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    public function sendMessage(string $message, int $chatId): void
    {
        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
        ]);
    }

    public function setWebHook(string $url)
    {
        return $this->telegram->setWebhook($url);
    }

    public function unsetWebHook()
    {
        return $this->telegram->deleteWebhook();
    }


}

