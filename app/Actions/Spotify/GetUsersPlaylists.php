<?php

namespace App\Actions\Spotify;

use App\Services\Spotify;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUsersPlaylists
{
    use AsAction;

    public function __construct(protected Spotify $spotify)
    {
        // ...
    }

    public function asController()
    {
        // get user
        $user = auth()->user();

        // make spotify request for playlists
        $response = $this->spotify->request(
            method: 'GET',
            endpoint: "users/$user->spotify_id/playlists");

        /**
         * TODO
         * - implement data object to return formatted playlist
         * - handle pagination
         */
        return $response->json();
    }
}
