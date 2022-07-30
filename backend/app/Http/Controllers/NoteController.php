<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\NoteService;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request, NoteService $noteService)
    {
        // return $request->name;
        $request->validate([
            'name' => 'string|nullable',
        ]);

        $notes = $noteService->getAll($request->name);

        return response()->json([
            'notes' => $notes,
        ], 200);
    }

    public function store(Request $request, NoteService $noteService)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'tag_ids' => 'array',
            'tag_ids.*' => 'numeric|exists:tags,id',
        ]);

        $user = User::where('id', 1)->firstOrFail();

        $note = $noteService->create($data, $user);

        return response()->json([
            'note' => $note
        ], 201);
    }
}
