<?php

use App\Models\User;

function actingAsUser()
{
    $user = User::factory()->create();
    test()->actingAs($user, 'sanctum');
    return test();
}
