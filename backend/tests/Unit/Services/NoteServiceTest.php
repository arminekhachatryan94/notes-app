<?php

namespace Tests\Unit\Models;

use App\Models\Note;
use App\Models\NoteTag;
use App\Models\Tag;
use App\Services\NoteService;
use Tests\TestCase;

class NoteServiceTest extends TestCase
{
    private NoteService $noteService;

    public function setUp(): void
    {
        $this->noteService = new NoteService();
        parent::setUp();
    }

    public function test_get_all()
    {
        $note1 = Note::factory()->create();
        $note2 = Note::factory()->create();

        $notes = $this->noteService->getAll();
        $noteIds = $notes->pluck('id')->toArray();

        // assert at least 2 notes are returned
        $this->assertGreaterThanOrEqual(2, $notes->count());
        // assert collection contains 2 notes that were previously created
        $this->assertContains($note1->id, $noteIds);
        $this->assertContains($note2->id, $noteIds);
        // assert collection is sorted in descending order
        $this->assertGreaterThanOrEqual($notes[0]->created_at, $notes[1]->created_at);
    }
}
