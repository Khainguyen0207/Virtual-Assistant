<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MessageController;

class AutoSendAdvice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-sendAdvice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $MessageController = new MessageController;
        $time = getdate(time());
        $date = $time['hours'] .":" .$time['minutes'] .":" .$time['seconds'] ." " .$time['mday'] ."/" .$time['mon'] ."/" .$time['year'];
        $MessageController->SendMessage(5572600385, null, '/morning', $date);
    }
}
