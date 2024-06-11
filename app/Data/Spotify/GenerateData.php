<?php

namespace App\Data\Spotify;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class GenerateData extends Data
{
    public int $length;

    #[DataCollectionOf(PlaylistData::class)]
    #[LiteralTypeScriptType('Array<PlaylistsData>')]
    public array $playlists;

}
