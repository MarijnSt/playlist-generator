<?php

namespace App\Data\Spotify;

use Spatie\LaravelData\Data;

class PlaylistData extends Data
{
    public string $id;

    public string $name;

    public ?string $image;

    public int $count;
}
