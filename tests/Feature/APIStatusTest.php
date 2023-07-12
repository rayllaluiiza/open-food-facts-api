<?php

namespace Tests\Feature;

use App\Models\APIStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class APIStatusTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_if_can_user_list_all_api_status(): void
    {
        $apiStatus = APIStatus::factory(3)->create();

        $response = $this->getJson('/api/status');

        $response->assertJsonCount(3);
        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use($apiStatus){
            $json->hasAll(['0.id', '0.status', '0.memoryConsumed', '0.date']);

            $json->whereAllType([
                '0.id' => 'integer',
                '0.status' => 'string',
                '0.memoryConsumed' => 'string',
                '0.date' => 'string'
            ]);

            $json->whereAll([
                '0.id' => $apiStatus[0]->id,
                '0.status' => $apiStatus[0]->status,
                '0.memoryConsumed' => $apiStatus[0]->memoryConsumed,
                '0.date' => $apiStatus[0]->date,
            ]);
        });
    }
}
