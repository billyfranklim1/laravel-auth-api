<?php

use App\Models\CORE\User;
use App\Models\v1\UserRole;
// use factory
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Models\CORE\System;

class AuthTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpSystems();
    }

    public function testSuccessfulAuth()
    {
        $systemId = System::first()->id;

        $password = 'test_password';

        $user = User::factory()->make([
            'password' => bcrypt($password),
        ]);
        $user->save();

        $user->syncSystems([$systemId]);

        $response = $this->json('POST', '/api/auth/login', [
            'email' => $user->email,
            'password' => $password,
            'system' => $systemId,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) => $json
                    ->has('data')
                    ->whereType('data', 'array')
                    ->has('data.message')
                    ->whereType('data.message', 'string')
                    ->has('data.token')
                    ->whereType('data.token', 'string')
            );
    }

    public function testInvalidSystem()
    {
        $password = 'test_password';

        $user = User::factory()->make([
            'password' => bcrypt($password),
        ]);

        $user->save();

        $response = $this->json('POST', '/api/auth/login', [
            'email' => $user->email,
            'password' => $password,
            'system' => 0
        ]);

        $response->assertStatus(401);

        $response->assertJson(
            fn (AssertableJson $json) => $json
                ->has('data')
                ->whereType('data', 'array')
                ->has('data.message')
                ->whereType('data.message', 'string')
                ->where('data.message', 'Usuário não autorizado a utilizar o sistema')
        );
    }

    public function testInvalidUsernameAuth()
    {
        $response = $this->json('POST', '/api/auth/login', [
            'username' => 'invalid@example.com',
            'password' => 'test_password',
            'system' => 1,
        ]);

        $response->assertStatus(422);

        $response->assertJson(
            fn (AssertableJson $json) => $json
                ->has('errors')
                ->has('errors.email')
                ->whereType('errors.email', 'array')
                ->where('errors.email.0', 'The email field is required.')
        );
    }

    public function testInvalidPassword()
    {
        $password = 'test_password';
        $systemId =  System::first()->id;

        $user = User::factory()->make([
            'password' => bcrypt($password),
        ]);
        $user->save();
        $user->syncSystems([$systemId]);

        $response = $this->json('POST', '/api/auth/login', [
            'email' => $user->email,
            'password' => 'invalid_password',
            'system' => $systemId,
        ]);

        $response->assertUnauthorized();

        $response->assertJson(
            fn (AssertableJson $json) => $json
                ->has('data')
                ->whereType('data', 'array')
                ->has('data.message')
                ->whereType('data.message', 'string')
                ->where('data.message', 'Email e/ou senha incorretas')
        );
    }
}
