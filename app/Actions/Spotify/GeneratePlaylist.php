<?php

namespace App\Actions\Spotify;

use App\Data\Spotify\GenerateData;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class GeneratePlaylist
{
    use AsAction;

    public function handle()
    {
        // validate data with GenerateData object
    }

    public function asController(GenerateData $data)
    {
        Log::info(json_encode($data));
    }
}
