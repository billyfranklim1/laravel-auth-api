<?php

namespace Tests\Feature\CORE\UnitType;

use App\Models\CORE\UnitType;
use App\Models\CORE\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DeleteUnitTypeTest extends TestCase
{
    protected UnitType $unitType;
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpSuperAdminAgent();

        $this->unitType = UnitType::factory()->create();
    }

    /**
     * @param User|null $agent
     * @param $unitTypeId
     * @return TestResponse
     */
    private function makeRequest(?User $agent, $unitTypeId = null): TestResponse
    {
        $uri = route('unit-type.destroy', ['unit_type' => !($unitTypeId) ? $this->unitType->id : $unitTypeId]);

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

        $response->assertStatus(Response::HTTP_OK)->assertJson(['data' => [
            'id' => $this->unitType->id,
            'description' => $this->unitType->description,
        ]]);
    }
}
