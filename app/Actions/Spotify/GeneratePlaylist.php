<?php

namespace App\Actions\Spotify;

use App\Data\Spotify\GenerateData;
use App\Services\Spotify;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class GeneratePlaylist
{
    use AsAction;

    private int $offset = 0;

    private int $limit = 50;

    public function __construct(protected Spotify $spotify)
    {
        // ...
    }

    public function handle(GenerateData $data): array
    {
        // combine all tracks in an array
        $tracks = $this->getAllTracks($data->playlists);

        // create new playlist
        return $this->createPlaylist($tracks, $data->length);
    }

    public function asController(GenerateData $data): JsonResponse
    {
        // get user
        $user = auth()->user();
        if (!$user) {
            abort(401);
        }

        $songs = $this->handle($data);

        return response()->json($songs);
    }

    private function getAllTracks(array $playlists): array
    {
        $tracks = [];

        // loop through all playlists
        foreach ($playlists as $playlist) {
            // collect all tracks of a playlist and add them to $tracks
            do {
                $response = $this->spotify->request(
                    method: 'GET',
                    endpoint: "/playlists/$playlist->id/tracks?offset=$this->offset&limit=$this->limit"
                );

                if ($response->failed()) {
                    $response->throw();
                }

                $data = $response->json();

                $tracks = array_merge($tracks, $data['items']);

                $this->offset += $this->limit;
            } while ($data['next']);
        }

        return $tracks;
    }

    private function createPlaylist(array $tracks, int $length): array
    {
        // convert length to milliseconds
        $lengthMs = $length * 60 * 1000;
        // init vars
        $playlist = [];
        $usedIndexes = [];
        $currentLength = 0;

        while ($currentLength < $lengthMs) {
            // grab random index
            $index = array_rand($tracks);

            // add song if it's not included yet
            if (!in_array($index, $usedIndexes)) {
                $usedIndexes[] = $index;
                $playlist[] = $tracks[$index];
                $currentLength += $tracks[$index]['track']['duration_ms'];
            }
        }

        return $playlist;
    }
}
