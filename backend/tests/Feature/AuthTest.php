<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

include_once __DIR__ . '/../TestHelpers.php';

it('can register a user', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'Gestor Teste',
        'email' => 'gestor@teste.com',
        'password' => 'senha123'
    ]);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'access_token',
            'token_type'
        ]);

    $this->assertDatabaseHas('users', [
        'email' => 'gestor@teste.com'
    ]);
});

it('can login a user', function () {
    $user = User::factory()->create([
        'email' => 'gestor@teste.com',
        'password' => bcrypt('senha123')
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'gestor@teste.com',
        'password' => 'senha123'
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'access_token',
            'token_type'
        ]);
});

//it('can logout a user', function () {
//    $user = User::factory()->create([
//        'email' => 'gestor@teste.com',
//        'password' => bcrypt('senha123')
//    ]);
//
//    $token = $user->createToken('auth_token')->plainTextToken;
//
//    $response = $this->actingAs($user, 'sanctum')
//        ->postJson('/api/logout');
//
//    $response->assertStatus(200)
//        ->assertJson(['message' => 'Logout realizado com sucesso']);
//});
