<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class CheckRoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_authorized()
    {
        $this->actingAsAdmin()
            ->get('/admin/dashboard')
            ->assertOk();
    }

    public function test_admin_forbidden()
    {
        $this->actingAsUser()
            ->get('/admin/dashboard')
            ->assertRedirect('/');

        $this->assertEquals(session('errors')->first(), 'Not authorized.');
    }
}
