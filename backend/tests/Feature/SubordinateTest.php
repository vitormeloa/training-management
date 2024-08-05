<?php

use App\Models\Subordinate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

include_once __DIR__ . '/../TestHelpers.php';

it('can list subordinates', function () {
    $user = User::factory()->create();
    Subordinate::factory()->count(3)->create(['user_id' => $user->id]);

    $response = $this->actingAs($user, 'sanctum')->getJson('/api/subordinates');

    $response->assertStatus(200)
        ->assertJsonCount(3);
});

it('can create a subordinate', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user, 'sanctum')->postJson('/api/subordinates', [
        'name' => 'Subordinado Teste',
        'email' => 'subordinado@teste.com'
    ]);

    $response->assertStatus(201)
        ->assertJsonFragment(['name' => 'Subordinado Teste']);

    $this->assertDatabaseHas('subordinates', [
        'email' => 'subordinado@teste.com',
        'user_id' => $user->id,
    ]);
});

it('can update a subordinate', function () {
    $user = User::factory()->create();
    $subordinate = Subordinate::factory()->create([
        'name' => 'Subordinado Antigo',
        'email' => 'subordinado@antigo.com',
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user, 'sanctum')->putJson("/api/subordinates/{$subordinate->id}", [
        'name' => 'Subordinado Atualizado',
        'email' => 'subordinado@atualizado.com'
    ]);

    $response->assertStatus(200)
        ->assertJsonFragment(['name' => 'Subordinado Atualizado']);

    $this->assertDatabaseHas('subordinates', [
        'id' => $subordinate->id,
        'name' => 'Subordinado Atualizado',
        'user_id' => $user->id,
    ]);
});

it('can delete a subordinate', function () {
    $user = User::factory()->create();
    $subordinate = Subordinate::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user, 'sanctum')->deleteJson("/api/subordinates/{$subordinate->id}");

    $response->assertStatus(204);

    $this->assertDatabaseMissing('subordinates', [
        'id' => $subordinate->id
    ]);
});

