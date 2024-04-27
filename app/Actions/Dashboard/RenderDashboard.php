<?php

namespace App\Actions\Dashboard;

use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class RenderDashboard
{
    use AsAction;

    public function asController(): Response
    {
        return Inertia::render(
            component:'Dashboard/Index',
            props: [
                'user' => auth()->user(),
            ]
        );
    }
}
