<?php

namespace Tests\Unit\Models;

use App\Models\Tag;
use App\Services\TagService;
use Tests\TestCase;

class TagServiceTest extends TestCase
{
    private TagService $tagService;

    public function setUp(): void
    {
        $this->tagService = new TagService();
        parent::setUp();
    }

    public function test_get_all()
    {
        $tag1 = Tag::factory()->create();
        $tag2 = Tag::factory()->create();

        $tags = $this->tagService->getAll();
        $tagIds = $tags->pluck('id')->toArray();

        // assert at least 2 tags are returned
        $this->assertGreaterThanOrEqual(2, $tags->count());
        // assert collection contains 2 tags that were previously created
        $this->assertContains($tag1->id, $tagIds);
        $this->assertContains($tag2->id, $tagIds);
        // assert collection is sorted in descending order
        $this->assertGreaterThanOrEqual($tags[0]->created_at, $tags[1]->created_at);
    }

    public function test_create()
    {
        $this->assertDatabaseMissing('tags', [
            'name' => 'MissingTagName',
        ]);

        $tag = $this->tagService->create('MissingTagName');

        $this->assertInstanceOf(Tag::class, $tag);
        $this->assertEquals('MissingTagName', $tag->name);
        $this->assertDatabaseHas('tags', [
            'name' => 'MissingTagName',
        ]);
    }

    public function test_delete()
    {
        $tag = Tag::factory()->create(['name' => 'UniqueTagName']);

        $this->assertDatabaseHas('tags', [
            'name' => 'UniqueTagName',
        ]);

        $deleted = $this->tagService->delete($tag);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('tags', [
            'name' => 'UniqueTagName',
        ]);
    }
}
