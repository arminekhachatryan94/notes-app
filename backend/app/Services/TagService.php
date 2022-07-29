<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Boolean;

class TagService
{
    public function getAll(): Collection
    {
        return Tag::all();
    }

    public function create(string $name): Tag
    {
        return Tag::create(['name' => $name]);
    }

    public function delete(Tag $tag): ?bool
    {
        return $tag->delete();
    }
}
