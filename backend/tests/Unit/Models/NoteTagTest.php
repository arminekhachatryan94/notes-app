<?php

namespace Tests\Unit\Models;

use App\Models\Note;
use App\Models\NoteTag;
use App\Models\Tag;
use Tests\TestCase;

class NoteTagTest extends TestCase
{
    /**
     * Test the noteTag->tag relationship
     */
    public function test_tag_relationship()
    {
        $note = Note::factory()->create();
        $tag = Tag::factory()->create();
        $noteTag = NoteTag::factory()->note($note)->tag($tag)->create();

        $this->assertInstanceOf(Tag::class, $noteTag->tag);
        $this->assertEquals($tag->id, $noteTag->tag->id);
    }

    /**
     * Test the noteTag->note relationship
     */
    public function test_note_relationship()
    {
        $note = Note::factory()->create();
        $tag = Tag::factory()->create();
        $noteTag = NoteTag::factory()->note($note)->tag($tag)->create();

        $this->assertInstanceOf(Note::class, $noteTag->note);
        $this->assertEquals($note->id, $noteTag->note->id);
    }
}
