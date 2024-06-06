<?php

namespace App\Data\Spotify;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PlaylistData extends Data
{
    public string $id;

    public string $name;

    public ?string $image;

    public int $count;
}
