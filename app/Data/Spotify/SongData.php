<?php

namespace App\Data\Spotify;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SongData extends Data
{
    public string $id;

    public string $uri;

    public string $name;

    public string $artist;

    public string $duration_ms;

    public string $duration_formatted;

    public string $image;
}
