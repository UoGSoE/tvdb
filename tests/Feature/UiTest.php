<?php

use App\Models\Tv;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

uses(TestCase::class);
uses(RefreshDatabase::class);

test('unauthenticated users are redirected to the login page', function () {
    $response = $this->get(route('home'));

    $response->assertRedirect(route('login'));
});

test('authenticated users can see the list of computers', function () {
    $user = User::factory()->create();
    $tv1 = Tv::factory()->create();
    $tv2 = Tv::factory()->create();

    $response = $this->actingAs($user)->get(route('home'));

    $response->assertOk();
    $response->assertSeeLivewire('computer-list');
    $response->assertSee($tv1->computer_name);
    $response->assertSee($tv1->computer_id);
    $response->assertSee($tv2->computer_name);
    $response->assertSee($tv2->computer_id);
});

test('we can search for a specific computer by id or name', function () {
    $user = User::factory()->create();
    $tv1 = Tv::factory()->create(['computer_name' => 'fred', 'computer_id' => '99999']);
    $tv2 = Tv::factory()->create(['computer_name' => 'ginger', 'computer_id' => '55555']);

    Livewire::actingAs($user)->test('computer-list')
        ->assertSee('fred')
        ->assertSee('ginger')
        ->set('searchTerm', 'fred')
        ->assertSee('fred')
        ->assertDontSee('ginger')
        ->set('searchTerm', '55555')
        ->assertDontSee('fred')
        ->assertSee('ginger');
});

test('authenticated users can see the list of existing api keys', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $token1 = $user1->createToken('hello kitty');
    $token2 = $user2->createToken('miffy');

    $response = $this->actingAs($user1)->get(route('apikeys'));

    $response->assertOk();
    $response->assertSeeLivewire('api-keys');
    $response->assertSeeLivewire('api-token-generator');
    $response->assertSee('hello kitty');
    $response->assertSee('miffy');
});

test('authenticated users can generate a new api key', function () {
    $user = User::factory()->create();

    $this->assertEquals(0, $user->tokens()->count());

    Livewire::actingAs($user)->test('api-token-generator')
        ->set('tokenName', 'hello')
        ->call('generate');

    $this->assertEquals(1, $user->tokens()->count());
});

test('authenticated users can revoke an existing api key', function () {
    $user = User::factory()->create();
    $token1 = $user->createToken('first');
    $token2 = $user->createToken('second');

    $this->assertEquals(2, $user->tokens()->count());

    Livewire::actingAs($user)->test('api-keys')
        ->call('revoke', $user->tokens->last()->id); // revoke 'second' api key

    $this->assertEquals(1, $user->tokens()->count());
    $this->assertTrue($user->fresh()->tokens->contains(fn ($token) => $token->name == 'first'));
});
