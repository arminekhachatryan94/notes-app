<?php

namespace Tests\Unit\Controllers;

use App\Models\Tag;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    /**
     * Test the get tags end point
     */
    public function test_index_passes()
    {
        $this->getJson(route('tags.index'))
            ->assertSuccessful()
            ->assertJsonStructure(['tags']);
    }

    /**
     * Test the create tag end point passes with valid input
     */
    public function test_create_passes_with_valid_input()
    {
        $this->postJson(route('tags.store', [
            'name' => 'TagName',
        ]))->assertSuccessful()
            ->assertJsonStructure(['tag']);
    }

    /**
     * Test the create tag end point fails with invalid input
     */
    public function test_create_fails_with_invalid_input()
    {
        $this->postJson(route('tags.store'), [
            'name' => 1,
        ])->assertUnprocessable();
    }

    /**
     * Test the delete tag end point
     */
    public function test_delete_passes()
    {
        $tag = Tag::factory()->create();
        $this->deleteJson(route('tags.delete', [
            'tag' => $tag->id,
        ]))->assertSuccessful();
    }

}
