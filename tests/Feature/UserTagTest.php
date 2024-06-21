<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tag;

class UserTagTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * A basic feature test example.
     */
    public function test_tag_creation(): void
    {
        $user = User::inRandomOrder()->limit(1)->get()->first();

        $tagName = 'Anime';

        $response = $this->actingAs($user)
            ->post(
                route('tags.create', [
                    'name' => $tagName
                ])
            );

        $response->assertStatus(200)
            ->assertJsonPath('tag.name', $tagName);
    }

    public function test_tag_create_duplicate(): void
    {
        $user = User::inRandomOrder()->limit(1)->get()->first();

        $tagName = 'Anime';

        $response = $this->actingAs($user)
            ->post(
                route('tags.create', [
                    'name' => $tagName
                ])
            );

        $response->assertStatus(200)
            ->assertJsonPath('tag.name', $tagName);
    }

    public function test_tag_error_creation(): void
    {
        $user = User::inRandomOrder()->limit(1)->get()->first();

        $response = $this->actingAs($user)
            ->post(
                route('tags.create'),
                [
                    'name' => ''
                ]
            );

        $response->assertStatus(302);
    }

    public function test_tag_update_success()
    {
        $user = User::inRandomOrder()->limit(1)->get()->first();
        $tag = Tag::inRandomOrder()->limit(1)->get()->first();

        $newTagName = 'Updated Post Name';
        $newTagIcon = './assets/icons/anime.svg';

        $response = $this->actingAs($user)
            ->post(
                route('tags.update', [
                    'tag' => $tag->id,
                    'name' => $newTagName,
                    'icon' => $newTagIcon
                ])
            );

        $response->assertStatus(200)
            ->assertJsonPath('tag.name', $newTagName)
            ->assertJsonPath('tag.icon', $newTagIcon);
    }
}
