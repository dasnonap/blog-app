<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Builder;
use App\Providers\RouteServiceProvider;

class AdminTokenTest extends TestCase
{
    // use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_create_admin_user(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => env('APP_ADMINISTRATOR_EMAIL'),
            'password' => 'password',
            'password_confirmation' => 'password',
            'username' => 'username_aa'
        ]);


        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * A basic feature test example.
     */
    public function test_user_token_creation(): void
    {
        $user = User::whereHas('role', function (Builder $query) {
            $query->where('type', '=', 'admin');
        })->get()->first();

        $this->assertNotEmpty($user, 'No admin user found');

        $response = $this->actingAs($user)
            ->post(route('tokens.create'), []);

        $response->assertStatus(200)
            ->assertJsonStructure(
                [
                    'token'
                ]
            );
    }
}
