<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagicalTalent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'effect',
    ];

    /**
     * Get all talents categorized by their category
     */
    public static function getTalentsByCategory()
    {
        $talents = self::all();
        $talentsByCategory = [];
        
        foreach ($talents as $talent) {
            if (!isset($talentsByCategory[$talent->category])) {
                $talentsByCategory[$talent->category] = [];
            }
            
            $talentsByCategory[$talent->category][] = [
                'id' => $talent->id,
                'name' => $talent->name,
                'description' => $talent->description,
                'effect' => $talent->effect,
            ];
        }
        
        return $talentsByCategory;
    }
}