<?php

namespace App\Telegram;

interface TelegramAPI{
    public function __consruct(string $token);
    public function getMessages(int $offset): array;
    public function sendMessage(string $chatId, string $text);

}



