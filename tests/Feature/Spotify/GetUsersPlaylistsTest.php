<?php

namespace Tests\Feature\Spotify;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GetUsersPlaylistsTest extends TestCase
{
    use WithFaker;

    public function test_get_users_playlist(): void
    {
        // fake playlist items
        $playListItems = [
            [
                'name' => $this->faker->sentence(3),
                'id' => $this->faker->randomNumber(5, true),
            ],
            [
                'name' => $this->faker->sentence(3),
                'id' => $this->faker->randomNumber(5, true),
            ],
            [
                'name' => $this->faker->sentence(3),
                'id' => $this->faker->randomNumber(5, true),
            ],
        ];

        // fake user
        $user = User::factory()->create();

        // mock the http client to simulate the response from the Spotify API
        Http::fake([
            "https://api.spotify.com/v1/users/$user->spotify_id/playlists" => Http::response([
                'items' => $playListItems,
            ]),
        ]);

        // make a request to the endpoint
        $response = $this->withSession([
            'auth' => [
                'spotify_token' => $this->faker->sha256,
                'spotify_refresh_token' => $this->faker->sha256,
                'spotify_expires_in' => now()->addSeconds(3600),
            ],
        ])->actingAs($user)->get('/spotify/playlists');

        // assert if user's spotify id is used in the request
        Http::assertSent(function ($request) use ($user) {
            return $request->url() == "https://api.spotify.com/v1/users/$user->spotify_id/playlists";
        });

        $response->assertStatus(200);
    }

    public function test_user_has_to_be_authenticated(): void
    {
        $response = $this->withSession([
            'auth' => [
                'spotify_token' => $this->faker->sha256,
                'spotify_refresh_token' => $this->faker->sha256,
                'spotify_expires_in' => now()->addSeconds(3600),
            ],
        ])->get('/spotify/playlists');

        $response->assertStatus(401);
    }

    public function test_request_fails_without_tokens_in_session(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/spotify/playlists');

        $response->assertStatus(500);
    }
}
