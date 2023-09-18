<?php

namespace Tests\Feature\Webclin\Anesthetist;

use App\Models\CORE\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Illuminate\Support\Str;

class CreateAnesthetistTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpSuperAdminAgent();

        $this->body = [
            'name' => Str::random(10) . '_' . time(),
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
        $uri = route('anesthetist.store', $params);

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
