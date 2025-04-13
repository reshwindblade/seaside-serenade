<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CombatSuitEffect extends Model
{
    use HasFactory;

    protected $fillable = [
        'combat_suit_id',
        'name',
        'description',
        'power_rating',
        'sort_order',
    ];

    protected $casts = [
        'power_rating' => 'integer',
    ];

    /**
     * Get the combat suit that owns the effect
     */
    public function combatSuit()
    {
        return $this->belongsTo(CombatSuit::class);
    }

    /**
     * Scope a query to order by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
