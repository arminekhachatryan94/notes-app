<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\NoteTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@email.com',
            'password' => bcrypt('password'),
        ]);

        $note1 = Note::factory()->user($user)->create();
        $note2 = Note::factory()->user($user)->create();
        $note3 = Note::factory()->user($user)->create();

        $tag1 = Tag::factory()->create(['name' => 'mathematics']);
        $tag2 = Tag::factory()->create(['name' => 'history']);
        $tag3 = Tag::factory()->create(['name' => 'science']);
        $tag4 = Tag::factory()->create(['name' => 'english']);
        $tag5 = Tag::factory()->create(['name' => 'engineering']);

        NoteTag::factory()->note($note1)->tag($tag1)->create();
        NoteTag::factory()->note($note1)->tag($tag2)->create();
        NoteTag::factory()->note($note2)->tag($tag2)->create();
        NoteTag::factory()->note($note2)->tag($tag3)->create();
        NoteTag::factory()->note($note2)->tag($tag4)->create();
        NoteTag::factory()->note($note3)->tag($tag4)->create();
        NoteTag::factory()->note($note3)->tag($tag5)->create();
    }

}
