<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TelegramDeleteWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:delete-webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete webhook for telegram api';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $telegramToken = config('telegram.look_token');

        if (!$telegramToken) {
            $this->error('TELEGRAM_BOT_TOKEN not found');
            return;
        }

        $response = Http::get("https://api.telegram.org/bot$telegramToken/deleteWebhook")->body();

        $this->info($response);
    }
}
