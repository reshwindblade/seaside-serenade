<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShortStory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'character_id',
        'title',
        'content',
        'story_date',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'story_date' => 'date',
    ];

    /**
     * Get the character that owns the short story
     */
    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    /**
     * Scope a query to only include active stories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by story date, then sort order, then title
     */
    public function scopeOrdered($query)
    {
        return $query->orderByDesc('story_date')
            ->orderBy('sort_order')
            ->orderBy('title');
    }
}