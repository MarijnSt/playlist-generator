<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginWithSpotify
{
    use AsAction;

    public function asController(): RedirectResponse
    {
        $spotifyUser = Socialite::driver('spotify')->user();

        // save user in db
        $user = User::updateOrCreate(
            ['email' => $spotifyUser->email],
            [
                'name' => $spotifyUser->name,
                'email' => $spotifyUser->email,
                'spotify_id' => $spotifyUser->id,
            ]
        );

        // save tokens in session
        session([
            'auth' => [
                'spotify_token' => $spotifyUser->token,
                'spotify_refresh_token' => $spotifyUser->refreshToken,
                'spotify_expires_in' => now()->addSeconds($spotifyUser->expiresIn),
            ]
        ]);

        // authenticate user
        Auth::login($user, remember: true);

        // redirect to dashboard
        return redirect()->route('dashboard');
    }
}
