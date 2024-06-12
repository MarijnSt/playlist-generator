<?php

namespace Tests\Feature\Spotify;

use App\Actions\Spotify\GetUsersPlaylists;
use App\Models\User;
use App\Services\Spotify;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

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
                'images' => [
                    ['url' => $this->faker->imageUrl()],
                ],
                'tracks' => [
                    'total' => $this->faker->randomNumber()
                ],
                'other-property' => 'test'
            ],
            [
                'name' => $this->faker->sentence(3),
                'id' => $this->faker->randomNumber(5, true),
                'images' => [
                    ['url' => $this->faker->imageUrl()],
                ],
                'tracks' => [
                    'total' => $this->faker->randomNumber()
                ]
            ],
            [
                'name' => $this->faker->sentence(3),
                'id' => $this->faker->randomNumber(5, true),
                'images' => [],
                'tracks' => [
                    'total' => $this->faker->randomNumber()
                ]
            ],
        ];

        // fake user
        $user = User::factory()->create();

        // mock the http client to simulate the response from the Spotify API
        Http::fake([
            "https://api.spotify.com/v1/me/playlists?offset=0&limit=50" => Http::response([
                'items' => $playListItems,
                'next' => null,
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
            return str_contains($request->url(), "https://api.spotify.com/v1/me/playlists");
        });

        $response->assertStatus(200);

        // create an instance of GetUsersPlaylists to get the getImageUrl function
        $getUsersPlaylists = new GetUsersPlaylists(new Spotify());

        // assert if response has the correct structure
        assertEquals($response->json(), [
            'playlists' => array_map(function ($playlist) use ($getUsersPlaylists) {
                return [
                    'id' => $playlist['id'],
                    'name' => $playlist['name'],
                    'image' => $getUsersPlaylists->getImageUrl($playlist['images']),
                    'count' => $playlist['tracks']['total'],
                ];
            }, $playListItems),
            'count' => count($playListItems),
        ]);
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
