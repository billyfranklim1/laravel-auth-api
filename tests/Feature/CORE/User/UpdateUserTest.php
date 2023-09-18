<?php

namespace Tests\Feature\CORE\User;

use App\Models\CORE\System;
use App\Models\CORE\User;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    protected User $user;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpSuperAdminAgent();

        $system = System::factory()->create();
        $role1 = Role::updateOrCreate(['name' => 'Teste']);
        $role2 = Role::updateOrCreate(['name' => 'Super-Admin']);
        $permission1 = Permission::updateOrCreate(['name' => 'edit test']);

        $this->user = User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => fake()->unique()->safeEmail(),
        ]);
        $this->user->assignRole($role1);
        $this->user->syncSystems([$system->id]);

        $AllSystemId = System::all()->pluck('id')->toArray();

        $this->body = [
            'user' => [
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => '12345678',
                'password_confirmation' => '12345678'
            ],
            'roles' => [$role2],
            'permissions' => [$permission1],
            'systems' => $AllSystemId
        ];
    }

    /**
     * @param User|null $agent
     * @param array $params
     * @param $userId
     * @return TestResponse
     */
    private function makeRequest(?User $agent, array $params = [], $userId = null): TestResponse
    {
        $uri = route('user.update', ['user' => !($userId) ? $this->user->id : $userId]);

        return ($agent) ? $this->actingAs($agent)->put($uri, $params) : $this->put($uri, $params);
    }

    /**
     * Testa o endpoint com id errado
     *
     * @return void
     */
    public function testNotFoundId(): void
    {
        $response = $this->makeRequest($this->agent, $this->body, 9999999999999);

        $response->assertUnprocessable();
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
            'message' => "Atualização realizada com sucesso"
        ]]);
    }
}
