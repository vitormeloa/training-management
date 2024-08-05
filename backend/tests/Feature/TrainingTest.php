<?php

use App\Models\Training;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

include_once __DIR__ . '/../TestHelpers.php';

it('can list trainings', function () {
    Training::factory()->count(3)->create();

    $response = actingAsUser()->getJson('/api/trainings');

    $response->assertStatus(200)
        ->assertJsonCount(3);
});

it('can create a training', function () {
    $response = actingAsUser()->postJson('/api/trainings', [
        'name' => 'Novo Treinamento',
        'description' => 'Descrição do novo treinamento'
    ]);

    $response->assertStatus(201)
        ->assertJsonFragment(['name' => 'Novo Treinamento']);

    $this->assertDatabaseHas('trainings', [
        'name' => 'Novo Treinamento'
    ]);
});

it('can update a training', function () {
    $training = Training::factory()->create([
        'name' => 'Treinamento Antigo',
        'description' => 'Descrição antiga'
    ]);

    $response = actingAsUser()->putJson("/api/trainings/{$training->id}", [
        'name' => 'Treinamento Atualizado',
        'description' => 'Descrição atualizada'
    ]);

    $response->assertStatus(200)
        ->assertJsonFragment(['name' => 'Treinamento Atualizado']);

    $this->assertDatabaseHas('trainings', [
        'id' => $training->id,
        'name' => 'Treinamento Atualizado'
    ]);
});

it('can delete a training', function () {
    $training = Training::factory()->create();

    $response = actingAsUser()->deleteJson("/api/trainings/{$training->id}");

    $response->assertStatus(204);

    $this->assertDatabaseMissing('trainings', [
        'id' => $training->id
    ]);
});
