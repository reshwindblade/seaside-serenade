<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagicalGirl extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_primary',
        'character_name',
        'magical_name',
        'signature_color',
        'animation_spirit',
        'transformation_phrase',
        'focus',
        'daring',
        'insight',
        'presence',
        'might',
        'proficient_skills',
        'mastered_skills',
        'stress',
        'harm',
        'physical_defense',
        'magical_defense',
        'bio',
        'portrait_url',
    ];

    protected $casts = [
        'proficient_skills' => 'array',
        'mastered_skills' => 'array',
        'is_primary' => 'boolean',
    ];

    /**
     * Get the user that owns the character.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculate and update derived stats based on attributes.
     */
    public function calculateDerivedStats()
    {
        // Calculate Stress (mental resilience)
        $this->stress = max(intval($this->insight / 2), intval($this->focus / 2));
        
        // Calculate Harm (physical endurance)
        $this->harm = max(intval($this->might / 2), intval($this->daring / 2));
        
        // Calculate Physical Defense
        $this->physical_defense = intval(($this->daring + $this->might) / 2);
        
        // Calculate Magical Defense
        $this->magical_defense = intval(($this->focus + $this->insight + $this->presence) / 3);
        
        return $this;
    }
    
    /**
     * Scope a query to only include primary characters.
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }
    
    /**
     * Set this character as the user's primary character.
     */
    public function setAsPrimary()
    {
        // First, unset any existing primary characters for this user
        self::where('user_id', $this->user_id)
            ->where('id', '!=', $this->id)
            ->update(['is_primary' => false]);
        
        // Set this one as primary
        $this->is_primary = true;
        $this->save();
        
        return $this;
    }
}