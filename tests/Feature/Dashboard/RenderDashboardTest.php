<?php

namespace Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class RenderDashboardTest extends TestCase
{
    public function test_dashboard_can_be_rendered(): void
    {
        $response = $this->get(route('dashboard'));

        $response
            ->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page->component('Dashboard/Index'));
    }
}
