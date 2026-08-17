<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
    {
        $sectors = Sector::orderBy('name')->get();
        return view('admin.sectors.index', compact('sectors'));
    }

    public function create()
    {
        return view('admin.sectors.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'active' => ['nullable', 'boolean'],
    ]);

    $validated['active'] = $request->boolean('active');

    Sector::create($validated);

    return redirect()
        ->route('sectors.index')
        ->with('success', 'Setor criado com sucesso.');
}

    public function show(Sector $sector)
    {
        //
    }

    public function edit(Sector $sector)
    {
        return view('admin.sectors.edit', compact('sector'));
    }

    public function update(Request $request, Sector $sector)
    {
        $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'active' => ['nullable', 'boolean'],
    ]);

    $validated['active'] = $request->boolean('active');
    
        $sector->update($validated);

        return redirect()
            ->route('sectors.index')
            ->with('success', 'Setor atualizado com sucesso.');
    }

    public function destroy(Sector $sector)
{
    if ($sector->users()->exists()) {
        return redirect()
            ->route('sectors.index')
            ->with('error', 'Este setor possui usuários vinculados e não pode ser excluído.');
    }

    $sector->delete();

    return redirect()
        ->route('sectors.index')
        ->with('success', 'Setor excluído com sucesso.');
}
}