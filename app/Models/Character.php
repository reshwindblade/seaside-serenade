<?php
// app/Models/Character.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'player_name',
        'image',
        'description',
        'is_active',
        'sort_order',
        'combat_suit_id',
        'signature_ability_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the character's image URL.
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/default-character.jpg');
        }

        return asset('storage/' . $this->image);
    }

    /**
     * Get the combat suit assigned to this character
     */
    public function combatSuit()
    {
        return $this->belongsTo(CombatSuit::class);
    }

    /**
     * Get the signature ability assigned to this character
     */
    public function signatureAbility()
    {
        return $this->belongsTo(SignatureAbility::class);
    }

    /**
     * Get the talents for this character
     */
    public function talents()
    {
        return $this->belongsToMany(Talent::class);
    }

    /**
     * Get the weaknesses for this character
     */
    public function weaknesses()
    {
        return $this->belongsToMany(Weakness::class);
    }

    /**
     * Get the short stories for this character
     */
    public function shortStories()
    {
        return $this->hasMany(ShortStory::class);
    }

    /**
     * Calculate the total power rating from all components
     */
    public function getTotalPowerRatingAttribute()
    {
        $powerRating = 0;

        // Add combat suit rating if exists
        if ($this->combatSuit) {
            $powerRating += $this->combatSuit->power_rating;
        }

        // Add signature ability rating if exists
        if ($this->signatureAbility) {
            $powerRating += $this->signatureAbility->power_rating;
        }

        // Add all talent ratings
        $powerRating += $this->talents()->sum('power_rating');

        // Add all weakness ratings (typically negative)
        $powerRating += $this->weaknesses()->sum('power_rating');

        return $powerRating;
    }

    /**
     * Scope a query to only include active characters.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by sort order and then by name.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}