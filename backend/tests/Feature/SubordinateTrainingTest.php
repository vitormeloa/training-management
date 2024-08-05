<?php

use App\Models\Subordinate;
use App\Models\Training;
use App\Models\SubordinateTraining;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

include_once __DIR__ . '/../TestHelpers.php';

it('can list subordinate trainings', function () {
    $subordinate = Subordinate::factory()->create();
    $training = Training::factory()->create();
    SubordinateTraining::factory()->create([
        'subordinate_id' => $subordinate->id,
        'training_id' => $training->id,
    ]);

    $response = actingAsUser()->getJson('/api/subordinate-trainings');

    $response->assertStatus(200)
        ->assertJsonCount(1);
});

it('can create a subordinate training', function () {
    $subordinate = Subordinate::factory()->create();
    $training = Training::factory()->create();

    $response = actingAsUser()->postJson('/api/subordinate-trainings', [
        'subordinate_id' => $subordinate->id,
        'training_id' => $training->id,
        'completed' => false
    ]);

    $response->assertStatus(201)
        ->assertJsonFragment(['completed' => false]);

    $this->assertDatabaseHas('subordinate_trainings', [
        'subordinate_id' => $subordinate->id,
        'training_id' => $training->id,
        'completed' => false
    ]);
});

it('can update a subordinate training', function () {
    $subordinate = Subordinate::factory()->create();
    $training = Training::factory()->create();
    $subordinateTraining = SubordinateTraining::factory()->create([
        'subordinate_id' => $subordinate->id,
        'training_id' => $training->id,
        'completed' => false
    ]);

    $response = actingAsUser()->putJson("/api/subordinate-trainings/{$subordinateTraining->id}", [
        'completed' => true
    ]);

    $response->assertStatus(200)
        ->assertJsonFragment(['completed' => true]);

    $this->assertDatabaseHas('subordinate_trainings', [
        'id' => $subordinateTraining->id,
        'completed' => true
    ]);
});

it('can delete a subordinate training', function () {
    $subordinate = Subordinate::factory()->create();
    $training = Training::factory()->create();
    $subordinateTraining = SubordinateTraining::factory()->create([
        'subordinate_id' => $subordinate->id,
        'training_id' => $training->id,
    ]);

    $response = actingAsUser()->deleteJson("/api/subordinate-trainings/{$subordinateTraining->id}");

    $response->assertStatus(204);

    $this->assertDatabaseMissing('subordinate_trainings', [
        'id' => $subordinateTraining->id
    ]);
});

