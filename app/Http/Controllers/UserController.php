<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('sector')
            ->orderBy('name')
            ->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $sectors = Sector::where('active', true)
            ->orderBy('name')
            ->get();

        return view('admin.users.create', compact('sectors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['super_admin', 'user'])],
            'sector_id' => [
                Rule::requiredIf(fn() => $request->role === 'user'),
                'nullable',
                'exists:sectors,id',
            ],
            
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'sector_id' => $validated['sector_id'] ?? null,
            'must_change_password' => true,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário criado com sucesso.');
    }

    public function edit(User $user)
    {
        $sectors = Sector::where('active', true)
            ->orderBy('name')
            ->get();

        return view('admin.users.edit', compact('user', 'sectors'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['super_admin', 'user'])],
            'sector_id' => [
                Rule::requiredIf(fn() => $request->role === 'user'),
                'nullable',
                'exists:sectors,id',
            ],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->sector_id = $validated['sector_id'] ?? null;

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Você não pode excluir o próprio usuário.');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário excluído com sucesso.');
    }
}
