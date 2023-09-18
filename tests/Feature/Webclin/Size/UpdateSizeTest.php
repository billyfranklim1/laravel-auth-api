<?php

namespace Tests\Feature\Webclin\Size;

use App\Models\Webclin\Size;
use App\Models\CORE\System;
use App\Models\CORE\User;
use Faker\Core\Number;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdateSizeTest extends TestCase
{
    protected Size $size;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpSuperAdminAgent();
        $this->size = Size::factory()->create();
        $number = new Number();

        $this->body = [
            'description' => Str::random(10) . '_' . time(),
            'time' => date('H:i:s', $number->randomFloat(0, 0, 86399))
        ];
    }

    /**
     * @param User|null $agent
     * @param array $params
     * @param $sizeId
     * @return TestResponse
     */
    private function makeRequest(?User $agent, array $params = [], $sizeId = null): TestResponse
    {
        $uri = route('size.update', ['size' => !($sizeId) ? $this->size->id : $sizeId]);

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
