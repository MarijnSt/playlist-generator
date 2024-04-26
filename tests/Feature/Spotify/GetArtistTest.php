<?php

namespace Tests\Feature\Spotify;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class GetArtistTest extends TestCase
{
    /**
     * A basic test to retrieve the spotify user to test the connection.
     */
    public function test_artist_can_be_retrieved(): void
    {
        $response = $this->get('/spotify/artist/31M8EXHYtEqOqVb1X7JRVe');

        $response
            ->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Spotify/Artist')
                ->where('artist.name', 'Dead Poet Society')
            )
            ->assertSee('Dead Poet Society');
    }
}
