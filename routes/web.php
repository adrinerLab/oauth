<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Minecraft\MicrosoftController;
use App\Http\Controllers\Minecraft\MinecraftController;
use App\Http\Controllers\Minecraft\MojangController;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::group([
    'middleware' => [
        'auth',
        'verified',
    ]
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/minecraft', [MinecraftController::class, 'index'])->name('minecraft.gate');
    Route::get('/mojang/consent', [MojangController::class, 'showForm'])->name('minecraft.mojang.consent');
    Route::post('/mojang/callback', [MojangController::class, 'handleCallback'])->name('minecraft.mojang.callback');
    Route::get('/microsoft/consent', [MicrosoftController::class, 'redirectToProvider'])->name('minecraft.microsoft.consent');
    Route::get('/microsoft/callback', [MicrosoftController::class, 'handleProviderCallback'])->name('minecraft.microsoft.callback');
});
