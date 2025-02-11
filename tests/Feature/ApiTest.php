<?php

use App\Models\Tv;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class);
uses(RefreshDatabase::class);

test('we can create a new entry via an api call', function () {
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
});

test('we can update an exiting entry via an api call', function () {
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
});

test('the computer name and id are required when making a call', function () {
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
});

test('the bearer token header is required and must be valid', function () {
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
});
