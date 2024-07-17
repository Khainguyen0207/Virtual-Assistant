<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\TelegramWebhookController;

Route::get('/', [MessageController::class, 'messageController']);
Route::post('/', [MessageController::class, 'store'])->name("msg.post");