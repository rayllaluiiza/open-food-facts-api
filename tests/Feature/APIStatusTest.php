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
        $ApiStatus = APIStatus::factory(3)->create();

        $response = $this->getJson('/api/status');

        $response->assertJsonCount(3);
        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use($ApiStatus){
            $json->hasAll(['0.id', '0.status', '0.memoryConsumed', '0.date']);

            $json->whereAllType([
                '0.id' => 'integer',
                '0.status' => 'string',
                '0.memoryConsumed' => 'string',
                '0.date' => 'string'
            ]);

            $json->whereAll([
                '0.id' => $ApiStatus[0]->id,
                '0.status' => $ApiStatus[0]->status,
                '0.memoryConsumed' => $ApiStatus[0]->memoryConsumed,
                '0.date' => $ApiStatus[0]->date,
            ]);
        });
    }
}
