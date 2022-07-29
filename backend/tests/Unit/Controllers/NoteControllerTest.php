<?php

namespace Tests\Unit\Controllers;

use App\Models\Tag;
use App\Models\User;
use Tests\TestCase;

class NoteControllerTest extends TestCase
{
    /**
     * Test the get notes end point
     */
    public function test_index_passes()
    {
        $this->getJson(route('notes.index'))
            ->assertSuccessful()
            ->assertJsonStructure(['notes']);
    }

    /**
     * Test the create note end point passes with valid input and no tags array
     */
    public function test_create_passes_with_valid_input_and_no_tags_array()
    {
        $this->postJson(route('notes.store', [
            'title' => 'Note 1 title',
            'description' => 'Note 1 description',
        ]))->assertSuccessful()
            ->assertJsonStructure(['note']);
    }

    /**
     * Test the create note end point passes with valid input and tags array
     */
    public function test_create_passes_with_valid_input_and_tags_array()
    {
        $tag1 = Tag::factory()->create();
        $this->postJson(route('notes.store', [
            'title' => 'Note 1 title',
            'description' => 'Note 1 description',
            'tags' => [$tag1->id],
        ]))->assertSuccessful()
            ->assertJsonStructure(['note']);
    }

    /**
     * Test the create note end point fails with invalid title and description
     */
    public function test_create_fails_with_invalid_title_and_description()
    {
        $this->postJson(route('notes.store'), [
            'title' => 1,
            'description' => false,
        ])->assertUnprocessable();
    }

    /**
     * Test the create note end point fails with invalid tag ids
     */
    public function test_create_fails_with_invalid_tag_ids()
    {
        $this->postJson(route('notes.store'), [
            'title' => 'hello',
            'description' => 'world',
            'tag_ids' => ['hi'],
        ])->assertUnprocessable();
    }

    /**
     * Test the create note end point fails with non-existing tag ids
     */
    public function test_create_fails_with_non_existing_tag_ids()
    {
        $this->postJson(route('notes.store'), [
            'title' => 'hello',
            'description' => 'world',
            'tag_ids' => [1000000, 1000001],
        ])->assertUnprocessable();
    }
}
