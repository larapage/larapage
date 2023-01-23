<?php

namespace Tests;

use App\Models\MediaLibrary;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        MediaLibrary::firstOrCreate([]);
    }

    /**
     * Return an admin user.
     *
     * @param mixed $overrides
     *
     * @return User $admin
     */
    protected function admin($overrides = [])
    {
        $admin = $this->user($overrides);
        $admin->roles()->attach(
            Role::factory()->admin()->create()
        );

        return $admin;
    }

    /**
     * Return an user.
     *
     * @param mixed $overrides
     *
     * @return User
     */
    protected function user($overrides = [])
    {
        return User::factory()->create($overrides);
    }

    /**
     * Acting as an admin.
     *
     * @param mixed|null $api
     */
    protected function actingAsAdmin($api = null)
    {
        $this->actingAs($this->admin(), $api);

        return $this;
    }

    /**
     * Acting as an user.
     *
     * @param mixed|null $api
     */
    protected function actingAsUser($api = null)
    {
        $this->actingAs($this->user(), $api);

        return $this;
    }
}
