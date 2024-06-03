<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Mockery;

class ApiControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $authService;

    public function setUp(): void
    {
        parent::setUp();
        $this->authService = Mockery::mock('App\Services\AuthServiceInterface');
        $this->app->instance('App\Services\AuthServiceInterface', $this->authService);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_register()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $result = [
            'token' => 'test_token'
        ];

        $this->authService
            ->shouldReceive('register')
            ->once()
            ->with($data)
            ->andReturn($result);

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'User created successfully',
                'token' => 'test_token',
            ]);
    }

    public function test_login()
    {
        $data = [
            'email' => $this->faker->email,
            'password' => 'password'
        ];

        $result = [
            'token' => 'test_token'
        ];

        $this->authService
            ->shouldReceive('login')
            ->once()
            ->with($data)
            ->andReturn($result);

        $response = $this->postJson('/api/login', $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'User logged in successfully',
                'token' => 'test_token',
            ]);
    }

    public function test_profile()
    {
        $user = User::factory()->create();
        $profileData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];

        Sanctum::actingAs($user, ['*']);

        $this->authService
            ->shouldReceive('profile')
            ->once()
            ->andReturn($profileData);

        $response = $this->getJson('/api/profile');

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Profile Information',
                'data' => $profileData,
            ]);
    }

    public function test_logout()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $this->authService
            ->shouldReceive('logout')
            ->once();

        $response = $this->getJson('/api/logout');

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'User logged out',
            ]);
    }
}