<?php

namespace App\Http\Controllers;

use App\Models\Occurrence;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Http\Request;

class OccurrenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = auth()->user();

    $query = Occurrence::with([
        'creator',
        'sector',
        'assignedUser',
    ]);

    if ($user->role !== 'super_admin') {
        $query->where('assigned_user_id', $user->id);
    }

    $occurrences = $query
        ->latest()
        ->get();

    return view('occurrences.index', compact('occurrences'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sectors = Sector::where('active', true)
            ->orderBy('name')
            ->get();

        return view('occurrences.create', compact('sectors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string'],
        'totem_model_id' => ['required', 'integer'],
        'order_number' => ['required', 'string', 'max:255'],
        'serial_number' => ['required', 'string', 'max:255'],
        'sector_id' => ['required', 'exists:sectors,id'],
        'priority' => ['required', 'in:low,medium,high,critical'],
    ]);

    $assignedUser = User::where('sector_id', $validated['sector_id'])
        ->where('role', 'user')
        ->where('active', true)
        ->withCount([
            'assignedOccurrences as active_occurrences_count' => function ($query) {
                $query->whereIn('status', [
                    'open',
                    'in_progress',
                ]);
            }
        ])
        ->orderBy('active_occurrences_count')
        ->orderBy('id')
        ->first();

    if (! $assignedUser) {
        return back()
            ->withInput()
            ->with('error', 'Não existem usuários ativos disponíveis neste setor.');
    }

    Occurrence::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'totem_model_id' => $validated['totem_model_id'],
        'order_number' => $validated['order_number'],
        'serial_number' => $validated['serial_number'],
        'created_by' => auth()->id(),
        'sector_id' => $validated['sector_id'],
        'assigned_user_id' => $assignedUser->id,
        'priority' => $validated['priority'],
        'status' => 'open',
    ]);

    return redirect()
        ->route('occurrences.index')
        ->with(
            'success',
            'Ocorrência criada e atribuída para '.$assignedUser->name.'.'
        );
}

    /**
     * Display the specified resource.
     */
    public function show(Occurrence $occurrence)
{
    $occurrence->load([
        'creator',
        'sector',
        'assignedUser',
    ]);

    return view('occurrences.show', compact('occurrence'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
