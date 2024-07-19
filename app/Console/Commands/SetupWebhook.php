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
        $url = env('DOMAIN_SETWEBHOOK');
        
        try {
            $telegram->setWebhook(['url' => env('DOMAIN_SETWEBHOOK')]);
        } catch (\Throwable $th) {
            $this->info("DOMAIN_SETWEBHOOK fail $url");
        }

        $this->info("DOMAIN_SETWEBHOOK success");
    }
}