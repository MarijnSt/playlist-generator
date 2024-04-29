<?php

namespace App\Actions\Spotify;

use App\Services\Spotify;
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

    public function asController()
    {
        // get user
        $user = auth()->user();
        if (!$user) {
            abort(401);
        }

        $playlists = $this->handle();
        //dd($playlists);

        /**
         * TODO
         * - implement data object to return formatted playlist
         */
        return response()->json($playlists);
    }
}
