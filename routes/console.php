<?php

use App\Jobs\SendMessageEveryday;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:auto-sendAdvice')->daily()->at('13:06');

//Thêm task + time thực hiện php artisan schedule::work sẽ thực hiện kiểm tả mỗi 10s