<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    /**
     * Relationships
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'note_tags', 'note_id', 'tag_id');
    }

    public function noteTags(): HasMany
    {
        return $this->hasMany(NoteTag::class, 'note_id', 'id');
    }

    /**
     * Scopes
     */

    public function scopeTagNameFilter(Builder $query, ?string $tagName = '')
    {
        if($tagName && $tagName !== '') {
            $query->whereHas('tags', function($query) use ($tagName) {
                $query->where('name', $tagName);
            });
        }
        return $query;
    }
}
