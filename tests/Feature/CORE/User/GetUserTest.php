<?php

namespace Tests\Feature\CORE\User;

use App\Models\CORE\User;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class GetUserTest extends TestCase
{
    protected User $user;
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpSuperAdminAgent();
        $this->user = User::factory()->create();
    }

    /**
     * @param User|null $agent
     * @param $userId
     * @return TestResponse
     */
    private function makeRequest(?User $agent, $userId = null): TestResponse
    {
        $uri = route('user.show', ['user' => !($userId) ? $this->user->id : $userId]);

        return ($agent) ? $this->actingAs($agent)->get($uri) : $this->get($uri);
    }

    /**
     * Testa o endpoint com id errado
     *
     * @return void
     */
    public function testNotFoundId(): void
    {
        $response = $this->makeRequest($this->agent, 9999999999999);

        $response->assertNotFound();
    }

    /**
     * Testa o endpoint sem a autorização.
     *
     * @return void
     */
    public function testUnauthorizedRequest(): void
    {
        $response = $this->makeRequest(null);

        $response->assertUnauthorized();
    }


    /**
     * Testa o codigo da resposta da requisição bem-sucedida.
     *
     * @return void
     */
    public function testSuccessfullyResponseStatusCode(): void
    {
        $response = $this->makeRequest($this->agent);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Testa o corpo da resposta da requisição bem-sucedida.
     *
     * @return void
     */
    public function testSuccessfullyResponseBody(): void
    {
        $response = $this->makeRequest($this->agent);
        $response->assertOk();

        $response->assertJson(fn(AssertableJson $json) => $json
            ->has('data', fn(AssertableJson $json) => $json
                ->hasAll([
                    'id',
                    'name',
                    'email',
                    'permissions',
                    'roles',
                    'systems',
                    'units'
                ])
                ->whereAllType([
                    'id' => 'integer',
                    'name' => 'string',
                    'email' => 'string',
                    'permissions' => 'array',
                    'roles' => 'array',
                    'systems' => 'array',
                    'units' => 'array'
                ])
            )
        );
    }
}
