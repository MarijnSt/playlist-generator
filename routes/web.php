<?php

use App\Actions\Dashboard\RenderDashboard;
use App\Actions\Spotify\GetArtist;
use Illuminate\Support\Facades\Route;

Route::get('/', RenderDashboard::class)->name('dashboard');

Route::prefix('spotify')->group(function () {
    Route::get('/artist/{id}', GetArtist::class)->name('spotify.test');
});
