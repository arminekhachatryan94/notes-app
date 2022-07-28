<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relationships
     */

    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'note_tags', 'tag_id', 'note_id');
    }

    public function noteTags(): HasMany
    {
        return $this->hasMany(NoteTag::class, 'tag_id', 'id');
    }
}
