<?php

namespace Tests\Unit\Models;

use App\Models\Note;
use App\Models\NoteTag;
use App\Models\Tag;
use App\Models\User;
use App\Services\NoteService;
use Database\Factories\TagFactory;
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

    public function test_create()
    {
        $tag1 = Tag::factory()->create(['name' => 'ExampleTag1']);
        $tag2 = Tag::factory()->create(['name' => 'ExampleTag2']);

        $user = User::firstOrFail();

        $this->assertDatabaseMissing('notes', [
            'title' => 'Missing Title',
            'description' => 'Missing Description',
            'user_id' => $user->id,
        ]);

        $note = $this->noteService->create([
            'title' => 'Missing Title',
            'description' => 'Missing Description',
            'tag_ids' => [$tag1->id, $tag2->id],
        ], $user);

        $this->assertInstanceOf(Note::class, $note);
        $this->assertEquals('Missing Title', $note->title);
        $this->assertEquals('Missing Description', $note->description);
        $this->assertEquals($user->id, $note->user_id);

        $tagIds = $note->tags->pluck('id')->toArray();
        $this->assertContains($tag1->id, $tagIds);
        $this->assertContains($tag2->id, $tagIds);

        $this->assertDatabaseHas('notes', [
            'title' => 'Missing Title',
            'description' => 'Missing Description',
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseHas('note_tags', [
            'note_id' => $note->id,
            'tag_id' => $tag1->id,
        ]);
        $this->assertDatabaseHas('note_tags', [
            'note_id' => $note->id,
            'tag_id' => $tag2->id,
        ]);
    }
}
