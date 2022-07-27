<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [];
    }

    public function note(Note $note)
    {
        return $this->state(fn (array $attributes) => [
            'note_id' => $note->id,
        ]);
    }

    public function tag(Tag $tag)
    {
        return $this->state(fn (array $attributes) => [
            'tag_id' => $tag->id,
        ]);
    }
}
