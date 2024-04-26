<?php

namespace App\Actions\Spotify;

use App\Services\Spotify;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class GetArtist
{
    use AsAction;

    public function __construct(public Spotify $spotify)
    {
    }

    public function asController(string $artistId)
    {
        // 31M8EXHYtEqOqVb1X7JRVe
        $response = $this->spotify->request(
            method: 'GET',
            endpoint: "artists/$artistId",
        );

        $artistData = $response->json();

        return Inertia::render(
            component: 'Spotify/Artist',
            props: [
                'artist' => $artistData
            ],
        );
    }
}
