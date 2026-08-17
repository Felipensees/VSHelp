<?php

use App\Models\User;

it('shows links to sectors and users in the admin dashboard', function () {
    $user = User::factory()->create([
        'role' => 'super_admin',
    ]);

    $response = $this->actingAs($user)->get('/admin');

    $response->assertOk();
    $response->assertSee('Setores');
    $response->assertSee('Usuários');
    $response->assertSee(route('sectors.index'));
    $response->assertSee(route('users.index'));
});
