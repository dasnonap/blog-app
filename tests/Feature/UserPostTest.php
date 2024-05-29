<?php

namespace Tests\Feature;

use App\Http\Resources\TagCollection;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;

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

    public function test_fill_random_tags()
    {
        $tags = Tag::factory(20)->create();

        $this->assertNotEmpty($tags, "Tags are not created");
    }

    public function test_user_post_creation(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('/api/posts/create', [
                'title' => 'aaa',
                'content' => json_encode([
                    'example' => 'com'
                ]),
                'slug' => 'test-example-alo',
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
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->patch(
                sprintf('/api/posts/%s/like', $post->id)
            );
        $response->assertSessionHasNoErrors();
    }

    public function test_user_post_unlike()
    {
        $post = Post::inRandomOrder()->limit(1)->get()->first();
        $user = User::inRandomOrder()->limit(1)->get()->first();

        $response = $this->actingAs($user)
            ->patch(
                route('posts.unlike', [$post->id])
            );

        $response
            ->assertStatus(200)
            ->assertJsonPath('post.liked', false);
    }

    public function test_user_post_dislike()
    {
        $post = Post::inRandomOrder()->limit(1)->get()->first();
        $user = User::inRandomOrder()->limit(1)->get()->first();

        $response = $this->actingAs($user)
            ->patch(
                route('posts.dislike', [$post->id])
            );

        $response
            ->assertStatus(200)
            ->assertJsonPath('post.disliked', true);
    }

    public function test_user_post_undislike()
    {
        $post = Post::inRandomOrder()->limit(1)->get()->first();
        $user = User::inRandomOrder()->limit(1)->get()->first();

        $response = $this->actingAs($user)
            ->patch(
                route('posts.undislike', [$post->id])
            );

        $response
            ->assertStatus(200)
            ->assertJsonPath('post.disliked', false);
    }

    public function test_user_post_create_with_tags()
    {
        $user = User::inRandomOrder()->limit(1)->get()->first();
        $tags = Tag::inRandomOrder()->limit(5)->get()->collect()->pluck('id')->toArray();

        $response = $this->actingAs($user)
            ->post(
                route('posts.create'),
                [
                    'title' => 'Post with Tags',
                    'content' => json_encode([
                        'example' => 'content'
                    ]),
                    'tags' => $tags
                ]
            );

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'post' => [
                    'tags'
                ]
            ]);
    }

    public function test_user_post_update_with_tags()
    {
        $user = User::with('posts')->has('posts', '>=', 1)->inRandomOrder()->limit(1)->get()->first();
        $tags = Tag::inRandomOrder()->limit(5)->get()->collect()->pluck('id')->toArray();
        $post = $user->posts->first();

        $response = $this->actingAs($user)
            ->post(
                route('posts.update', [
                    $post->id
                ]),
                [
                    'title' => 'Updated Post with Tags',
                    'tags' => $tags,
                ]
            );

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'post' => [
                    'tags'
                ]
            ]);
    }
}
