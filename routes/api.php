<?php

use Illuminate\Support\Facades\Route;
use Look\LookSelection\Infrastructure\Controller\TelegramController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(static function() {
    Route::prefix('look')->group(static function() {
        Route::post('telegram', TelegramController::class);
    });
});
