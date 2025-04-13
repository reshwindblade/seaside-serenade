<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CombatSuit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
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
     * Get the effects for the combat suit
     */
    public function effects()
    {
        return $this->hasMany(CombatSuitEffect::class);
    }

    /**
     * Get the characters that use this combat suit
     */
    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    /**
     * Calculate the total power rating from all effects
     */
    public function calculatePowerRating()
    {
        return $this->effects()->sum('power_rating');
    }

    /**
     * Update the power rating based on effects
     */
    public function updatePowerRating()
    {
        $this->power_rating = $this->calculatePowerRating();
        $this->save();
    }

    /**
     * Scope a query to only include active combat suits
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