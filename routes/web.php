<?php

use App\Actions\Auth\LoginWithSpotify;
use App\Actions\Auth\Logout;
use App\Actions\Index\RenderIndex;
use App\Actions\Spotify\GetUsersPlaylists;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', RenderIndex::class)->name('dashboard');

Route::prefix('auth')->group(function () {
    Route::get('/spotify', fn() => Socialite::driver('spotify')
        ->scopes(['user-read-email', 'user-read-private', 'playlist-read-private'])
        ->redirect())
        ->name('auth.spotify');
    Route::get('/spotify/callback', LoginWithSpotify::class)->name('auth.spotify.callback');

    Route::middleware('auth')
        ->post('logout', Logout::class)
        ->name('auth.logout');
});

Route::prefix('spotify')->group(function () {
    Route::get('playlists', GetUsersPlaylists::class)->name('spotify.playlists');
});
