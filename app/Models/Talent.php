<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Talent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category',
        'description',
        'power_rating',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'power_rating' => 'integer',
    ];

    /**
     * Get the characters that have this talent
     */
    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }

    /**
     * Get all unique categories
     */
    public static function categories()
    {
        return self::select('category')
            ->distinct()
            ->pluck('category')
            ->toArray();
    }

    /**
     * Scope a query to only include active talents
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope a query to order by category, then sort order, then name
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('category')->orderBy('sort_order')->orderBy('name');
    }
}