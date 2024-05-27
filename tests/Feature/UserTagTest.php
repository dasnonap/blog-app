<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTagTest extends TestCase
{
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
}
