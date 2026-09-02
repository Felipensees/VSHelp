<?php

namespace App\Http\Controllers;

class AccessScriptController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (
            $user->role !== 'super_admin'
            && strtolower($user->sector?->name ?? '') !== 'qualidade'
        ) {
            abort(403);
        }

        return view('access-script.index');
    }
}