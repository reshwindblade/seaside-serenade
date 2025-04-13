<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SignatureAbility extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'effect',
        'cooldown',
        'power_rating',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'power_rating' => 'integer',
    ];

    /**
     * Get the characters that have this signature ability
     */
    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    /**
     * Scope a query to only include active abilities
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by sort order and then by name
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}