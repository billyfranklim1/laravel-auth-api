<?php

namespace Tests\Feature\Webclin\BloodComponent;

use App\Models\Webclin\BloodComponent;
use App\Models\CORE\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DeleteBloodComponentTest extends TestCase
{
    protected BloodComponent $bloodComponent;
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpSuperAdminAgent();

        $this->bloodComponent = BloodComponent::factory()->create();
    }

    /**
     * @param User|null $agent
     * @param $bloodComponentId
     * @return TestResponse
     */
    private function makeRequest(?User $agent, $bloodComponentId = null): TestResponse
    {
        $uri = route('blood-component.destroy', ['blood_component' => !($bloodComponentId) ? $this->bloodComponent->id : $bloodComponentId]);

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
            'id' => $this->bloodComponent->id,
            'description' => $this->bloodComponent->description,
        ]]);
    }
}
