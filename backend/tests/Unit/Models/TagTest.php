<?php

namespace Tests\Unit\Models;

use App\Models\Note;
use App\Models\NoteTag;
use App\Models\Tag;
use App\Models\User;
use Tests\TestCase;

class TagTest extends TestCase
{
    /**
     * Test the tag->notes relationship
     */
    public function test_notes_relationship()
    {
        $tag = Tag::factory()->create();

        $numNotes = rand(1, 5);
        $notes = Note::factory($numNotes)->create();
        $notes->each(function($note) use ($tag) {
            NoteTag::factory()->tag($tag)->note($note)->create();
        });

        $this->assertCount($numNotes, $tag->notes);

        $noteIds = $tag->notes->pluck('id')->toArray();
        $notes->each(function($note) use ($noteIds) {
            $this->assertInstanceOf(Note::class, $note);
            $this->assertContains($note->id, $noteIds);
        });
    }

    /**
     * Test the tag->noteTags relationship
     */
    public function test_note_tags_relationship()
    {
        $tag = Tag::factory()->create();

        $note1 = Note::factory()->create();
        $note2 = Note::factory()->create();
        NoteTag::factory()->tag($tag)->note($note1)->create();
        NoteTag::factory()->tag($tag)->note($note2)->create();

        $this->assertCount(2, $tag->noteTags);

        $noteTagIds = $tag->noteTags->pluck('note_id')->toArray();
        $this->assertInstanceOf(NoteTag::class, $tag->noteTags->first());
        $this->assertContains($note1->id, $noteTagIds);
        $this->assertContains($note2->id, $noteTagIds);
    }
}
