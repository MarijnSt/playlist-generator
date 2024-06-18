<?php

namespace App\Actions\Spotify;

use App\Data\Spotify\CreateData;
use App\Services\Spotify;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePlaylist
{
    use AsAction;

    public function __construct(protected Spotify $spotify)
    {
        // ...
    }

    public function handle(string $user_id, CreateData $data): string
    {
        Log::info(json_encode($data));
        // create playlist
        $playlist_id = $this->createPlaylistInSpotify($user_id, $data->name);

        // add songs
        $this->addSongsToPlaylist($playlist_id, $data->uris);

        return $playlist_id;
    }

    public function asController(CreateData $data): JsonResponse
    {
        // get user
        $user = auth()->user();
        if (!$user) {
            abort(401);
        }

        // create playlist
        try {
            $playlist_id = $this->handle($user['spotify_id'], $data);
            // return json response with playlist link
            return response()->json([
                "playlist_link" => "https://open.spotify.com/playlist/$playlist_id"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "error" => $e
            ], 500);
        }
    }

    private function createPlaylistInSpotify(string $user_id, string $name): string
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

        return $response['id'];
    }

    private function addSongsToPlaylist(string $playlist_id, array $uris): void
    {
        $response = $this->spotify->request(
            method: 'POST',
            endpoint: "/playlists/$playlist_id/tracks",
            data: [
                "uris" => $uris
            ]
        );

        if ($response->failed()) {
            $response->throw();
        }
    }
}
