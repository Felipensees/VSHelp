<?php

use App\Models\TotemInspection;
use App\Models\User;

it('filters totem inspections by creation date', function () {
    $user = User::factory()->create([
        'role' => 'super_admin',
    ]);

    TotemInspection::forceCreate([
        'order_number' => 'PEDIDO-DO-DIA',
        'serial_number' => 'SERIAL-DO-DIA',
        'created_by' => $user->id,
        'status' => 'draft',
        'created_at' => '2026-08-30 10:00:00',
        'updated_at' => '2026-08-30 10:00:00',
    ]);

    TotemInspection::forceCreate([
        'order_number' => 'PEDIDO-OUTRO-DIA',
        'serial_number' => 'SERIAL-OUTRO-DIA',
        'created_by' => $user->id,
        'status' => 'draft',
        'created_at' => '2026-08-29 10:00:00',
        'updated_at' => '2026-08-29 10:00:00',
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('totem-inspections.index', [
            'inspection_date' => '2026-08-30',
        ]));

    $response
        ->assertOk()
        ->assertSee('Filtros de busca')
        ->assertSee('Filtrar inspeções')
        ->assertSee('PEDIDO-DO-DIA')
        ->assertDontSee('PEDIDO-OUTRO-DIA')
        ->assertSee('value="2026-08-30"', false);
});
