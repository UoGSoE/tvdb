<?php

namespace Tests\Feature;

use App\Models\Tv;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function we_can_create_a_new_entry_via_an_api_call(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test');

        $result = $this->postJson(route('api.computer.update'), [
            'computer_name' => 'TEST123',
            'computer_id' => '12345',
        ], [
            'Authorization' => 'Bearer '.$token->plainTextToken,
        ]);

        $result->assertOk();
        tap(Tv::first(), function ($tv) {
            $this->assertEquals('TEST123', $tv->computer_name);
            $this->assertEquals('12345', $tv->computer_id);
        });
    }

    /** @test */
    public function we_can_update_an_exiting_entry_via_an_api_call(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test');
        $tv = Tv::factory()->create([
            'computer_name' => 'Jimmy',
            'computer_id' => '98765',
        ]);

        $result = $this->postJson(route('api.computer.update'), [
            'computer_name' => 'Jimmy',
            'computer_id' => '99999',
        ], [
            'Authorization' => 'Bearer '.$token->plainTextToken,
        ]);

        $result->assertOk();
        tap(Tv::first(), function ($tv) {
            $this->assertEquals('Jimmy', $tv->computer_name);
            $this->assertEquals('99999', $tv->computer_id);
        });
    }

    /** @test */
    public function the_computer_name_and_id_are_required_when_making_a_call(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test');

        $result = $this->postJson(route('api.computer.update'), [
            'computer_name' => '',
            'computer_id' => '',
        ], [
            'Authorization' => 'Bearer '.$token->plainTextToken,
        ]);

        $result->assertStatus(422);
        $result->assertJson([
            'message' => 'The computer name field is required. (and 1 more error)',
            'errors' => [
                'computer_name' => ['The computer name field is required.'],
                'computer_id' => ['The computer id field is required.'],
            ],
        ]);
        $this->assertEquals(0, Tv::count());
    }

    /** @test */
    public function the_bearer_token_header_is_required_and_must_be_valid(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test');

        $result = $this->postJson(route('api.computer.update'), [
            'computer_name' => 'fred',
            'computer_id' => '12345',
        ], [
        ]);

        $result->assertUnauthorized();
        $this->assertEquals(0, Tv::count());

        $result = $this->postJson(route('api.computer.update'), [
            'computer_name' => 'fred',
            'computer_id' => '12345',
        ], [
            'Authorization' => 'Bearer '.'not-a-valid-token',
        ]);

        $result->assertUnauthorized();
        $this->assertEquals(0, Tv::count());
    }
}
