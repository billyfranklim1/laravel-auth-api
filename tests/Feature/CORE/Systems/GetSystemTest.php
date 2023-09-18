<?php

namespace Tests\Feature\CORE\Systems;

use App\Models\CORE\System;
use App\Models\CORE\User;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class GetSystemTest extends TestCase
{
    protected System $system;
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpSuperAdminAgent();
        $this->system = System::factory()->create();
    }

    /**
     * @param User|null $agent
     * @param $systemId
     * @return TestResponse
     */
    private function makeRequest(?User $agent, $systemId = null): TestResponse
    {
        $uri = route('system.show', ['system' => !($systemId) ? $this->system->id : $systemId]);

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
                    'system',
                ])
                ->whereAllType([
                    'id' => 'integer',
                    'system' => 'string',
                ])
            )
        );
    }
}
