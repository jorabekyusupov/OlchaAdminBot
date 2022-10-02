<?php

namespace App\Services;

interface TelegramServiceInterface
{

    public function sendMessage(string $message, int $chatId): void;

    public function setWebHook(string $url);

    public function unsetWebHook();

}
