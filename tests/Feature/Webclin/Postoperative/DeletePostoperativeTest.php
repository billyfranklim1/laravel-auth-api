<?php

namespace Tests\Feature\Webclin\Postoperative;

use App\Models\Webclin\Postoperative;
use App\Models\CORE\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DeletePostoperativeTest extends TestCase
{
    protected Postoperative $postoperative;
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpSuperAdminAgent();

        $this->postoperative = Postoperative::factory()->create();
    }

    /**
     * @param User|null $agent
     * @param $postoperativeId
     * @return TestResponse
     */
    private function makeRequest(?User $agent, $postoperativeId = null): TestResponse
    {
        $uri = route('postoperative.destroy', ['postoperative' => !($postoperativeId) ? $this->postoperative->id : $postoperativeId]);

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
            'id' => $this->postoperative->id,
            'description' => $this->postoperative->description,
        ]]);
    }
}
