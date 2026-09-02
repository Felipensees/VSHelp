<?php

use App\Models\TotemInspection;
use App\Models\User;

it('only searches for the order PDF on the inspection checklist', function () {
    $user = User::factory()->create([
        'role' => 'user',
        'must_change_password' => false,
    ]);

    $inspection = TotemInspection::create([
        'order_number' => 'PEDIDO-123',
        'serial_number' => 'SERIAL-123',
        'created_by' => $user->id,
        'status' => 'draft',
    ]);

    $this->actingAs($user)
        ->get(route('totem-inspections.create'))
        ->assertOk()
        ->assertDontSee('pdf-status');

    $this->actingAs($user)
        ->get(route('totem-inspections.show', $inspection))
        ->assertOk()
        ->assertSee('PDF do pedido')
        ->assertSee('inspection-pdf')
        ->assertSee(route('totem-inspections.search-pdf', [
            'pedido' => $inspection->order_number,
        ]));
});
