<?php

namespace Tests\Unit\Models;

use App\Models\Note;
use App\Models\NoteTag;
use App\Models\Tag;
use App\Models\User;
use Tests\TestCase;

class NoteTest extends TestCase
{
    /**
     * Test the note->user relationship
     */
    public function test_user_relationship()
    {
        $user = User::factory()->create();
        $note = Note::factory()->user($user)->create();

        $this->assertInstanceOf(User::class, $note->user);
        $this->assertEquals($user->id, $note->user->id);
    }

    /**
     * Test the note->tags relationship
     */
    public function test_tags_relationship()
    {
        $user = User::factory()->create();
        $note = Note::factory()->user($user)->create();

        $numTags = rand(1, 5);
        $tags = Tag::factory($numTags)->create();
        $tags->each(function($tag) use ($note) {
            NoteTag::factory()->note($note)->tag($tag)->create();
        });

        $this->assertCount($numTags, $note->tags);

        $tagIds = $note->tags->pluck('id')->toArray();
        $tags->each(function($tag) use ($tagIds) {
            $this->assertInstanceOf(Tag::class, $tag);
            $this->assertContains($tag->id, $tagIds);
        });
    }

    /**
     * Test the note->noteTags relationship
     */
    public function test_note_tags_relationship()
    {
        $user = User::factory()->create();
        $note = Note::factory()->user($user)->create();

        $tag1 = Tag::factory()->create();
        $tag2 = Tag::factory()->create();
        NoteTag::factory()->note($note)->tag($tag1)->create();
        NoteTag::factory()->note($note)->tag($tag2)->create();

        $this->assertCount(2, $note->noteTags);

        $noteTagIds = $note->noteTags->pluck('tag_id')->toArray();
        $this->assertInstanceOf(NoteTag::class, $note->noteTags->first());
        $this->assertContains($tag1->id, $noteTagIds);
        $this->assertContains($tag2->id, $noteTagIds);
    }

    /**
     * Test the tag name filter
     */
    public function test_tag_name_filter()
    {
        $tagIncluded = Tag::factory()->create(['name' => 'included']);
        $tagExcluded = Tag::factory()->create(['name' => 'excluded']);

        $noteIncluded = Note::factory()->create();
        $noteExcluded = Note::factory()->create();

        $noteIncluded->tags()->attach($tagIncluded->id);
        $noteExcluded->tags()->attach($tagExcluded->id);

        $result = Note::tagNameFilter('included')->get();
        $resultIds = $result->pluck('id')->toArray();

        $this->assertContains($noteIncluded->id, $resultIds);
        $this->assertNotContains($noteExcluded->id, $resultIds);
    }
}
