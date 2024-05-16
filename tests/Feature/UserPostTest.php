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
            ->has(Post::factory()->count(20))
            ->create();

        $response = $this->get('/api/posts');

        $response->assertStatus(200);
    }

    public function test_user_post_creation(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('/api/posts/create', [
                'title' => 'aaa',
                'content' => json_encode([
                    'example' => 'com'
                ])
            ]);

        $response
            ->assertSessionHasNoErrors();

        $post = $response->getData()->post;

        $this->assertNotEmpty($post, "Post not created.");
    }

    public function test_user_create_and_get_post(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('/api/posts/create', [
                'title' => 'aaa',
                'content' => json_encode([
                    'example' => 'com'
                ])
            ]);

        $response
            ->assertSessionHasNoErrors();

        $post = $response->getData()->post;

        $this->assertNotEmpty($post, "Post not created.");

        $response = $this->actingAs($user)
            ->get(sprintf('/api/posts/%s/edit', $post->id));

        $response->assertSessionHasNoErrors();

        $this->assertNotEmpty($post, "Post information empty");
    }

    public function test_post_update()
    {
        $user = User::factory()
            ->has(Post::factory()->count(1))
            ->create();

        $post = $user->posts()->first();

        $this->assertNotEmpty($post, "Post not created.");

        $response = $this->actingAs($user)
            ->post(
                sprintf('/api/posts/%s/edit', $post->id),
                [
                    'title' => 'aaa',
                    'content' => json_encode([
                        'example' => 'com'
                    ])
                ]
            );

        $response->assertSessionHasNoErrors();
    }

    public function test_user_post_like()
    {
        $post = Post::inRandomOrder()->limit(1)->get()->first();

        $this->assertNotEmpty($post, 'Post not found');

        $response = $this->patch(
            sprintf('/api/posts/%s/like', $post->id)
        );

        $response->assertSessionHasNoErrors();
    }
}
