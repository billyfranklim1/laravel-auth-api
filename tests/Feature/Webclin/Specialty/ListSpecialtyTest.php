<?php

namespace Tests\Feature\Webclin\Specialty;

use App\Models\Webclin\Specialty;
use App\Models\CORE\System;
use App\Models\CORE\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ListSpecialtyTest extends TestCase
{
    protected Specialty $specialty;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpSuperAdminAgent();
        Specialty::factory()->create();
        Specialty::factory()->create();
    }

    /**
     * @param User|null $agent
     * @return TestResponse
     */
    private function makeRequest(?User $agent): TestResponse
    {
        $uri = route('specialty.index');

        return ($agent) ? $this->actingAs($agent)->get($uri) : $this->get($uri);
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
                ->each(fn(AssertableJson $json) => $json
                    ->hasAll([
                        'id',
                        'description',
                    ])
                    ->whereAllType([
                        'id' => 'integer',
                        'description' => 'string',
                    ])
                )
            )
            ->has('links')->has('meta')
        );
    }
}
