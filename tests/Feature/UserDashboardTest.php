<?php

use App\Models\User;

it('shows the main shortcuts in the user dashboard', function () {
    $user = User::factory()->create([
        'role' => 'user',
        'must_change_password' => false,
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertOk();
    $response->assertSee('Ocorrências');
    $response->assertSee('Totens');
    $response->assertSee(route('occurrences.index'));
    $response->assertSee(route('totem-inspections.index'));
    $response->assertSee('Gerador de Acesso');
    $response->assertSee(route('access-script.index'));
});

it('allows authenticated users to access the occurrences landing page', function () {
    $user = User::factory()->create([
        'role' => 'user',
        'must_change_password' => false,
    ]);

    $this->actingAs($user)
        ->get(route('occurrences.index'))
        ->assertOk()
        ->assertSee('Módulo de ocorrências');
});
