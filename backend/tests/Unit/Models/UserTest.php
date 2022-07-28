<?php

namespace Tests\Unit\Models;

use App\Models\Note;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Test the user->notes relationship
     */
    public function test_notes_relationship()
    {
        $user = User::factory()->create();
        $note1 = Note::factory()->user($user)->create();
        $note2 = Note::factory()->user($user)->create();
        $this->assertCount(2, $user->notes);

        $noteIds = $user->notes->pluck('id')->toArray();
        $this->assertInstanceOf(Note::class, $user->notes->first());
        $this->assertContains($note1->id, $noteIds);
        $this->assertContains($note2->id, $noteIds);
    }
}
