<?php

namespace Tests\Feature\CORE\User;

use App\Models\CORE\System;
use App\Models\CORE\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpSuperAdminAgent();

        Role::updateOrCreate(['name' => 'Super-Admin']);

        $this->body = [
            'user' => [
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => '12345678',
                'password_confirmation' => '12345678'
            ],
            'roles' => ['Super-Admin'],
            'permissions' => [],
        ];
    }

    /**
     * Executa a requisição no endpoint de cadastro de usuários
     *
     * @param User|null $agent
     * @param array $params
     * @return TestResponse
     */
    private function makeRequest(?User $agent, array $params = []): TestResponse
    {
        $uri = route('user.store', $params);

        return ($agent) ? $this->actingAs($agent)->post($uri) : $this->post($uri);
    }

    /**
     * Testa o endpoint sem a autorização.
     *
     * @return void
     */
    public function testUnauthorizedRequest(): void
    {
        $response = $this->makeRequest(null, $this->body);

        $response->assertUnauthorized();
    }


    /**
     * Testa o codigo da resposta da requisição bem-sucedida.
     *
     * @return void
     */
    public function testSuccessfullyResponseStatusCode(): void
    {
        $response = $this->makeRequest($this->agent, $this->body);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Testa o corpo da resposta da requisição bem-sucedida.
     *
     * @return void
     */
    public function testSuccessfullyResponseBody(): void
    {
        $response = $this->makeRequest($this->agent, $this->body);

        $response->assertStatus(Response::HTTP_OK)->assertJson(['data' => [
            'message' => "Criação realizada com sucesso"
        ]]);
    }
}
