<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Socialite\Facades\Socialite;
use Tests\TestCase;

class LoginWithSpotifyTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_users_can_login_with_spotify(): void
    {
        $spotifyUser = [
            'id' => $this->faker->uuid,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'token' => $this->faker->sha256,
            'refreshToken' => $this->faker->sha256,
            'expiresIn' => 3600,
        ];

        Socialite::shouldReceive('driver->user')->andReturn((object) $spotifyUser);

        $response = $this->get(route('auth.spotify.callback'));

        $this->assertDatabaseHas('users', [
            'name' => $spotifyUser['name'],
            'email' => $spotifyUser['email'],
            'spotify_id' => $spotifyUser['id'],
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard'));
        // TODO: assert if session has the tokens
    }

    public function test_refresh_token_is_used_for_new_access_token(): void
    {
        // TODO
    }
}
