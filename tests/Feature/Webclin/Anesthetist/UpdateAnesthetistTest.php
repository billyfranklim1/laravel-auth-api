<?php

namespace Tests\Feature\Webclin\Anesthetist;

use App\Models\Webclin\Anesthetist;
use App\Models\CORE\System;
use App\Models\CORE\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdateAnesthetistTest extends TestCase
{
    protected Anesthetist $anesthetist;
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpSuperAdminAgent();
        $this->anesthetist = Anesthetist::factory()->create();

        $this->body = [
            'name' => Str::random(10) . '_' . time(),
        ];
    }

    /**
     * @param User|null $agent
     * @param array $params
     * @param $anesthetistId
     * @return TestResponse
     */
    private function makeRequest(?User $agent, array $params = [], $anesthetistId = null): TestResponse
    {
        $uri = route('anesthetist.update', ['anesthetist' => !($anesthetistId) ? $this->anesthetist->id : $anesthetistId]);

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
