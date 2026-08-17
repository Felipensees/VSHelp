<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FirstLoginPasswordController extends Controller
{
    public function edit()
    {
        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user = $request->user();

        $user->password = Hash::make($validated['password']);
        $user->must_change_password = false;
        $user->save();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Senha alterada com sucesso.');
    }
}