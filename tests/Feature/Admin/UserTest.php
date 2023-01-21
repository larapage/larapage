<?php

namespace Tests\Feature\Admin;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $lara_page_user = User::factory()->defaultLarapageUser()->create();
        User::factory()->count(3)->create();
        Post::factory()->count(3)->create(['author_id' => $lara_page_user->id]);

        $this->actingAsAdmin()
            ->get('/admin/users')
            ->assertOk()
            ->assertSee('5 users')
            ->assertSee('3')
            ->assertSee('larapage@larapage.org')
            ->assertSee('Lara Page')
            ->assertSee('Name')
            ->assertSee('Email')
            ->assertSee('Registered at');
    }

    public function testEdit()
    {
        $lara_page_user = User::factory()->defaultLarapageUser()->create();

        $this->actingAsAdmin()
            ->get("/admin/users/{$lara_page_user->id}/edit")
            ->assertOk()
            ->assertSee('Lara Page')
            ->assertSee('Show profile')
            ->assertSee('larapage@larapage.org')
            ->assertSee('Password confirmation')
            ->assertSee('Roles')
            ->assertSee('Update')
            ->assertSee('Administrator');
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        $params = $this->validParams();

        $this->actingAsAdmin()
            ->patch("/admin/users/{$user->id}", $params)
            ->assertRedirect("/admin/users/{$user->id}/edit");

        $this->assertDatabaseHas('users', $params);
        $this->assertEquals($params['email'], $user->refresh()->email);
    }

    public function testUpdateRoles()
    {
        $user = User::factory()->create();

        $role_editor = Role::factory()->editor()->create();
        $params = $this->validParams(['roles' => ['editor' => $role_editor->id]]);

        $this->actingAsAdmin()
            ->patch("/admin/users/{$user->id}", $params)
            ->assertRedirect("/admin/users/{$user->id}/edit");

        $this->assertTrue($user->refresh()->roles->pluck('id')->contains($role_editor->id));
    }

    /**
     * Valid params for updating or creating a resource
     *
     * @param  array  $overrides new params
     * @return array  Valid params for updating or creating a resource
     */
    private function validParams($overrides = [])
    {
        return array_merge([
            'name' => 'Lara Page',
            'email' => 'larapage@larapage.org',
        ], $overrides);
    }
}
