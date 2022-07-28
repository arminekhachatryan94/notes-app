<?php

namespace App\Services;

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Collection;

class NoteService
{
    public function getAll(string $tagName = ''): Collection
    {
        return Note::with(['user', 'tags'])
            ->tagNameFilter($tagName)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function create(array $attributes, User $user): Note
    {
        return Note::create([
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'user_id' => $user->id,
        ]);
    }
}
