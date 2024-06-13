<?php

namespace App\Actions\Spotify;

use App\Data\Spotify\CreateData;
use App\Services\Spotify;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePlaylist
{
    use AsAction;

    public function __construct(protected Spotify $spotify)
    {
        // ...
    }

    public function handle(string $user_id, CreateData $data): void
    {
        // create playlist
        $this->createPlaylistInSpotify($user_id, $data->name);

        // add songs
    }

    public function asController(CreateData $data)
    {
        // get user
        $user = auth()->user();
        if (!$user) {
            abort(401);
        }

        // create playlist
        $this->handle($user['spotify_id'], $data);
    }

    // create playlist in spotify
    private function createPlaylistInSpotify(string $user_id, string $name):void
    {
        $response = $this->spotify->request(
            method: 'POST',
            endpoint: "/users/$user_id/playlists",
            data: [
                "name" => $name
            ]
        );

        if ($response->failed()) {
            $response->throw();
        }

        Log::info(json_encode($response));
    }
}
