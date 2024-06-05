<?php

namespace App\Data\Spotify;

use Spatie\LaravelData\Data;

class PlaylistsData extends Data
{
    #[DataCollectionOf(PlaylistData::class)]
    public array $playlists;

    public int $count;
}
