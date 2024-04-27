<?php

namespace App\Actions\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class Logout
{
    use AsAction;

    public function asController(ActionRequest $request): RedirectResponse
    {
        // logout the user and clear the session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // redirect to dashboard
        return redirect()->route('dashboard');
    }
}
