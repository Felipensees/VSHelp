<?php

namespace App\Http\Controllers;

use App\Models\TotemInspection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\InspectionSection;
use App\Models\InspectionItem;

class TotemInspectionController extends Controller
{
    public function create()
    {
        return view('totem-inspections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_number' => [
                'required',
                'string',
                'max:255',
            ],

            'serial_number' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $exists = TotemInspection::where('order_number', $validated['order_number'])
            ->where('serial_number', $validated['serial_number'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'serial_number' => 'Já existe uma inspeção cadastrada para este Pedido e Serial.',
                ]);
        }

        $inspection = TotemInspection::create([
            'order_number' => $validated['order_number'],
            'serial_number' => $validated['serial_number'],
            'created_by' => auth()->id(),
            'status' => 'draft',
        ]);

        return redirect()
            ->route('totem-inspections.show', $inspection);
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        $query = TotemInspection::with('creator')
            ->latest();

        if ($user->role !== 'super_admin') {
            $query->where('created_by', $user->id);
        }

        $totemInspections = $query
            ->paginate(10)
            ->withQueryString();

        return view('totem-inspections.index', compact('totemInspections'));
    }

    public function show(TotemInspection $totemInspection)
    {
        $user = auth()->user();

        if (
            $user->role !== 'super_admin'
            && $totemInspection->created_by !== $user->id
        ) {
            abort(403);
        }

        $sections = InspectionSection::where('active', true)
            ->with([
                'items' => function ($query) {
                    $query->where('active', true)
                        ->orderBy('sort_order');
                }
            ])
            ->orderBy('sort_order')
            ->get();

        $totemInspection->load([
            'creator',
            'answers',
        ]);

        $savedAnswers = $totemInspection->answers
            ->pluck('result', 'inspection_item_id');

        return view('totem-inspections.show', compact(
            'totemInspection',
            'sections',
            'savedAnswers'
        ));
    }
    public function update(Request $request, TotemInspection $totemInspection)
    {
        $user = auth()->user();

        if (
            $user->role !== 'super_admin'
            && $totemInspection->created_by !== $user->id
        ) {
            abort(403);
        }

        if (
            $totemInspection->status === 'finalized'
            && $user->role !== 'super_admin'
        ) {
            return back()->with(
                'error',
                'Esta inspeção já foi finalizada e não pode mais ser alterada.'
            );
        }

        $validated = $request->validate([
            'action' => [
                'required',
                'in:draft,finalize',
            ],

            'answers' => [
                'nullable',
                'array',
            ],

            'answers.*' => [
                'nullable',
                'in:ok,na',
            ],
        ]);

        $answers = $validated['answers'] ?? [];

        foreach ($answers as $itemId => $result) {

            $item = InspectionItem::where('id', $itemId)
                ->where('active', true)
                ->first();

            if (! $item) {
                continue;
            }

            $totemInspection->answers()->updateOrCreate(
                [
                    'inspection_item_id' => $item->id,
                ],
                [
                    'result' => $result,
                ]
            );
        }

        if ($validated['action'] === 'finalize') {

            $totalItems = InspectionItem::where('active', true)->count();

            $answeredItems = $totemInspection->answers()
                ->whereHas('item', function ($query) {
                    $query->where('active', true);
                })
                ->count();

            if ($answeredItems < $totalItems) {

                $remaining = $totalItems - $answeredItems;

                return back()->with(
                    'error',
                    "Ainda existem {$remaining} item(ns) sem resposta."
                );
            }

            $totemInspection->update([
                'status' => 'finalized',
                'finalized_at' => now(),
            ]);

            return back()->with(
                'success',
                'Inspeção finalizada com sucesso.'
            );
        }

        return back()->with(
            'success',
            'Rascunho salvo com sucesso.'
        );
    }

    public function finalize(TotemInspection $totemInspection)
    {
        $user = auth()->user();

        if (
            $user->role !== 'super_admin'
            && $totemInspection->created_by !== $user->id
        ) {
            abort(403);
        }

        if ($totemInspection->status === 'finalized') {
            return back()->with(
                'error',
                'Esta inspeção já foi finalizada.'
            );
        }

        $totalItems = InspectionItem::where('active', true)->count();

        $answeredItems = $totemInspection->answers()
            ->whereHas('item', function ($query) {
                $query->where('active', true);
            })
            ->count();

        if ($answeredItems < $totalItems) {
            $remaining = $totalItems - $answeredItems;

            return back()->with(
                'error',
                "Ainda existem {$remaining} item(ns) sem resposta."
            );
        }

        $totemInspection->update([
            'status' => 'finalized',
            'finalized_at' => now(),
        ]);

        return back()->with(
            'success',
            'Inspeção finalizada com sucesso.'
        );
    }
}
