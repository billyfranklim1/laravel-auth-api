<?php

namespace Tests\Feature\Webclin\BloodType;

use App\Models\Webclin\BloodType;
use App\Models\CORE\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class GetBloodTypeTest extends TestCase
{
    protected BloodType $bloodType;
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpSuperAdminAgent();

        $this->bloodType = BloodType::factory()->create();
    }

    /**
     * @param User|null $agent
     * @param $bloodTypeId
     * @return TestResponse
     */
    private function makeRequest(?User $agent, $bloodTypeId = null): TestResponse
    {
        $uri = route('blood-type.show', ['blood_type' => !($bloodTypeId) ? $this->bloodType->id : $bloodTypeId]);

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
                    'description',
                ])
                ->whereAllType([
                    'id' => 'integer',
                    'description' => 'string',
                ])
            )
        );
    }
}
