<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recap extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'session_number',
        'session_date',
        'content',
        'is_active',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'session_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that created the recap.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope a query to only include active recaps.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by session date in descending order.
     */
    public function scopeLatest($query)
    {
        return $query->orderByDesc('session_date')->orderByDesc('session_number');
    }

    /**
     * Get the recap's summary (first 200 characters).
     */
    public function getSummaryAttribute()
    {
        $plainText = strip_tags($this->content);
        if (strlen($plainText) > 200) {
            return substr($plainText, 0, 200) . '...';
        }
        return $plainText;
    }
}