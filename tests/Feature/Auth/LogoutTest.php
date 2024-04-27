<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_logout(): void
    {
        $user = User::factory()->create();

        Auth::login($user);
        $this->assertAuthenticated();

        $response = $this->post(route('auth.logout'));

        $response->assertRedirect(route('dashboard'));
        $this->assertGuest();
    }
}
