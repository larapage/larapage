<?php

namespace Tests\Unit;

use App\Models\Token;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class TokenTest extends TestCase
{
    use RefreshDatabase;

    public function test_generate()
    {
        $user = User::factory()->create();

        $this->assertNotEquals($user->api_token, Token::generate());
    }
}
