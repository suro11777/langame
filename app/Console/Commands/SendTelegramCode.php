<?php

namespace App\Console\Commands;

use App\Services\RabbitMQService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use TelegramBot\Api\BotApi;

class SendTelegramCode extends Command
{
    protected $signature = 'send:telegram-code';

    protected $description = 'Send confirmation code to Telegram';

    public function handle(): void
    {
        try {
            $service = new RabbitMQService;

            $service->rabbitConnect();

            $callback = function ($msg) {
                $telegram = new BotApi(config('settings.telegram_bot_token'));
                $telegram->sendMessage(
                    config('settings.telegram_chat_id'),
                    'Your confirmation code: '.$msg->body
                );
            };

            $service->consume($callback);

            while (true) {
                $service->channel->wait();
            }
        } catch (\Exception $e) {
            Log::error('Error in RabbitMQ: '.$e->getMessage().$e->getFile().$e->getLine());
        }
    }
}
