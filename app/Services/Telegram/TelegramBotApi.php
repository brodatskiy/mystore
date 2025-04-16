<?php

namespace App\Services\Telegram;

use Illuminate\Support\Facades\Http;
use Throwable;

class TelegramBotApi
{
    public const string HOST = 'https://api.telegram.org/bot';
    public static function sendMessage(string $token, int $chatId, string $text): void
    {
        try {
            Http::get(self::HOST . $token . '/sendMessage', [
                'chat_id' => $chatId,
                'text' => $text
            ]);
        } catch (Throwable $th) {
            //throw $th;
        }
    }
}
