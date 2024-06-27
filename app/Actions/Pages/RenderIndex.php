<?php

namespace App\Actions\Pages;

use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class RenderIndex
{
    use AsAction;

    public function asController(): Response
    {
        return Inertia::render(
            component:'Index',
            props: [
                'user' => auth()->user(),
            ]
        );
    }
}
