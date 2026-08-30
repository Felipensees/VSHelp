<?php

namespace App\Http\Controllers;

use App\Models\Occurrence;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\OccurrenceHistory;

class OccurrenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $user = auth()->user();

    $tab = $request->get('tab', 'progress');

    $query = Occurrence::with([
        'creator',
        'sector',
        'assignedUser',
    ]);

    // Super Admin vê todas.
    // Usuário comum vê somente as atribuídas a ele.
    if ($user->role !== 'super_admin') {
        $query->where('assigned_user_id', $user->id);
    }

    if ($tab === 'finished') {
        $query->whereIn('status', [
            'resolved',
            'closed',
        ]);
    } else {
        $query->whereIn('status', [
            'open',
            'in_progress',
        ]);
    }

    $occurrences = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('occurrences.index', compact(
        'occurrences',
        'tab'
    ));
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

    public function start(Occurrence $occurrence)
{
    if (
        auth()->user()->role !== 'super_admin'
        && $occurrence->assigned_user_id !== auth()->id()
    ) {
        abort(403);
    }

    if ($occurrence->status !== 'open') {
        return back()->with(
            'error',
            'Esta ocorrência não pode ser iniciada.'
        );
    }

    $oldStatus = $occurrence->status;

    $occurrence->update([
        'status' => 'in_progress',
        'started_at' => now(),
    ]);

    OccurrenceHistory::create([
        'occurrence_id' => $occurrence->id,
        'user_id' => auth()->id(),
        'action' => 'status_changed',
        'from_status' => $oldStatus,
        'to_status' => 'in_progress',
        'description' => 'Atendimento iniciado.',
    ]);

    return back()->with(
        'success',
        'Atendimento iniciado com sucesso.'
    );
}

public function resolve(Occurrence $occurrence)
{
    if (
        auth()->user()->role !== 'super_admin'
        && $occurrence->assigned_user_id !== auth()->id()
    ) {
        abort(403);
    }

    if ($occurrence->status !== 'in_progress') {
        return back()->with(
            'error',
            'Esta ocorrência não pode ser marcada como resolvida.'
        );
    }

    $oldStatus = $occurrence->status;

    $occurrence->update([
        'status' => 'resolved',
        'resolved_at' => now(),
    ]);

    OccurrenceHistory::create([
        'occurrence_id' => $occurrence->id,
        'user_id' => auth()->id(),
        'action' => 'status_changed',
        'from_status' => $oldStatus,
        'to_status' => 'resolved',
        'description' => 'Ocorrência marcada como resolvida.',
    ]);

    return back()->with(
        'success',
        'Ocorrência marcada como resolvida.'
    );
}

public function close(Occurrence $occurrence)
{
    $user = auth()->user();

    if (
        $user->role !== 'super_admin'
        && $occurrence->created_by !== $user->id
    ) {
        abort(403);
    }

    if ($occurrence->status !== 'resolved') {
        return back()->with(
            'error',
            'A ocorrência precisa estar resolvida antes de ser encerrada.'
        );
    }

    $oldStatus = $occurrence->status;

    $occurrence->update([
        'status' => 'closed',
        'closed_at' => now(),
    ]);

    OccurrenceHistory::create([
        'occurrence_id' => $occurrence->id,
        'user_id' => auth()->id(),
        'action' => 'status_changed',
        'from_status' => $oldStatus,
        'to_status' => 'closed',
        'description' => 'Ocorrência encerrada.',
    ]);

    return back()->with(
        'success',
        'Ocorrência encerrada com sucesso.'
    );
}


}
