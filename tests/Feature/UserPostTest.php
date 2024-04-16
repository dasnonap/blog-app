<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class UserPostTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_post(): void
    {
        $user = User::factory()
            ->has(Post::factory()->count(3))
            ->create();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
