<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\NoteService;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(NoteService $noteService)
    {
        $notes = $noteService->getAll();

        return response()->json([
            'notes' => $notes,
        ]);
    }

    public function store(Request $request, NoteService $noteService)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $user = User::where('id', 1)->firstOrFail();

        $note = $noteService->create($data, $user);

        return response()->json([
            'note' => $note
        ]);
    }
}