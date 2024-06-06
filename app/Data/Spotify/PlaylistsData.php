<?php

namespace App\Data\Spotify;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PlaylistsData extends Data
{
    #[DataCollectionOf(PlaylistData::class)]
    #[LiteralTypeScriptType('Array<PlaylistsData> | null')]
    public array $playlists;

    public int $count;
}
