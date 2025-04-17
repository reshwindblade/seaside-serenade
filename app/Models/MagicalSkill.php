<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagicalSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'attribute',
        'description',
    ];

    /**
     * Get all skills mapped by attribute
     */
    public static function getSkillsByAttribute()
    {
        $skills = self::all();
        $skillsByAttribute = [];
        
        foreach ($skills as $skill) {
            if (!isset($skillsByAttribute[$skill->attribute])) {
                $skillsByAttribute[$skill->attribute] = [];
            }
            
            $skillsByAttribute[$skill->attribute][] = [
                'id' => $skill->id,
                'name' => $skill->name,
                'description' => $skill->description,
            ];
        }
        
        return $skillsByAttribute;
    }
    
    /**
     * Get all available skills as an array
     */
    public static function getAllSkillsArray()
    {
        return self::all()->pluck('name', 'id')->toArray();
    }
}