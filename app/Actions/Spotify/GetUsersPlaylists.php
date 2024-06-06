<?php

namespace App\Actions\Spotify;

use App\Data\Spotify\PlaylistData;
use App\Data\Spotify\PlaylistsData;
use App\Services\Spotify;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUsersPlaylists
{
    use AsAction;

    private int $offset = 0;

    private int $limit = 50;

    public function __construct(protected Spotify $spotify)
    {
        // ...
    }

    public function handle(): array
    {
        $playlists = [];

        do {
            $response = $this->spotify->request(
                method: 'GET',
                endpoint: "me/playlists?offset=$this->offset&limit=$this->limit",
            );

            if ($response->failed()) {
                $response->throw();
            }

            $data = $response->json();

            $playlists = array_merge($playlists, $data['items']);

            $this->offset += $this->limit;
        } while ($data['next']);

        return $playlists;
    }

    public function asController(): PlaylistsData
    {
        // get user
        $user = auth()->user();
        if (!$user) {
            abort(401);
        }

        $playlists = $this->handle();

        return PlaylistsData::from([
            'playlists' => array_map(function ($playlist) {
                return PlaylistData::from([
                    'id' => $playlist['id'],
                    'name' => $playlist['name'],
                    'image' => $this->getImageUrl($playlist['images']),
                    'count' => $playlist['tracks']['total'],
                ]);
            }, $playlists),
            'count' => count($playlists),
        ]);
    }

    public function getImageUrl(array $images): string
    {
        /*
         * Spotify returns three images if they auto-generated the mosaic,
         * it returns one image if the playlist doesn't have enough tracks,
         * it also returns one image if the playlist has a custom image,
         * and it returns an empty array if the playlist has no image
         * */

        if (count($images) === 3) {
            return $images[1]['url'];
        } elseif (count($images) === 1) {
            return $images[0]['url'];
        } else {
            return Storage::url('images/default-playlist-image.png');
        }
    }
}
