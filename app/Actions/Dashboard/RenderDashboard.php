<?php

namespace App\Actions\Dashboard;

use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class RenderDashboard
{
    use AsAction;

    public function asController(): Response
    {
        Log::info('render dashboard');
        Log::info(auth()->user());
        return Inertia::render(
            component:'Dashboard/Index',
            props: [
                'user' => auth()->user(),
            ]
        );
    }
}
