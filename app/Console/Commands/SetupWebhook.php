<?php

namespace App\Console\Commands;

use Telegram\Bot\Api;

use Illuminate\Console\Command;
use function PHPUnit\Framework\isEmpty;

class SetupWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup-webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set url for setup-webhook';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $telegram = new Api(config('services.telegram.bot_token'));
        $url_file = trim(fread(fopen("ngrok/setout.txt", "r"), filesize("ngrok/setout.txt"))) ."/VirtualAssistant/public/telegram/webhook";
        try {
            $telegram->setWebhook(['url' => $url_file]);
            $this->info("DOMAIN SETUP SUCCESS");
        } catch (\Throwable $th) {
            $this->info("Hãy chạy lại lệnh php artisan app:setup-webhook");
        }

    }
}