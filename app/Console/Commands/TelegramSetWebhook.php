<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TelegramSetWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:set-webhook {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set webhook for telegram api';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $telegramToken = config('bot.telegram_token');

        if (!$telegramToken) {
            $this->error('TELEGRAM_BOT_TOKEN not found');
            return;
        }

        $url = $this->argument('url');
        $response = Http::get("https://api.telegram.org/bot$telegramToken/setWebhook?url=$url")->body();

        $this->info($response);
    }
}
