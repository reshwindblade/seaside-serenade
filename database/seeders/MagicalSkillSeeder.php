<?php

namespace Database\Seeders;

use App\Models\MagicalSkill;
use Illuminate\Database\Seeder;

class MagicalSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            // Focus skills
            [
                'name' => 'Spellcasting',
                'attribute' => 'Focus',
                'description' => 'The ability to cast magical spells with precision and control.',
            ],
            [
                'name' => 'Ritual',
                'attribute' => 'Focus',
                'description' => 'Knowledge and execution of magical rituals and ceremonies.',
            ],
            [
                'name' => 'Fine Control',
                'attribute' => 'Focus',
                'description' => 'Precise manipulation of magical energy for delicate tasks.',
            ],
            [
                'name' => 'Analysis',
                'attribute' => 'Focus',
                'description' => 'Breaking down complex magical phenomena to understand their components.',
            ],
            [
                'name' => 'Willpower',
                'attribute' => 'Focus',
                'description' => 'Mental fortitude to resist magical influence and maintain concentration.',
            ],
            
            // Daring skills
            [
                'name' => 'Acrobatics',
                'attribute' => 'Daring',
                'description' => 'Performing feats of agility, balance, and coordination.',
            ],
            [
                'name' => 'Movement',
                'attribute' => 'Daring',
                'description' => 'Swift and nimble movement in various environments.',
            ],
            [
                'name' => 'Courage',
                'attribute' => 'Daring',
                'description' => 'Facing fear and danger with bravery and determination.',
            ],
            
            // Insight skills
            [
                'name' => 'Observation',
                'attribute' => 'Insight',
                'description' => 'Noticing details and perceiving the world accurately.',
            ],
            [
                'name' => 'Instinct',
                'attribute' => 'Insight',
                'description' => 'Intuitive understanding and gut feelings about situations.',
            ],
            [
                'name' => 'Empathy',
                'attribute' => 'Insight',
                'description' => 'Understanding and connecting with others\' emotions.',
            ],
            [
                'name' => 'Strategy',
                'attribute' => 'Insight',
                'description' => 'Planning and executing effective tactics in complex situations.',
            ],
            
            // Presence skills
            [
                'name' => 'Persuasion',
                'attribute' => 'Presence',
                'description' => 'Convincing others through charisma and logical argument.',
            ],
            [
                'name' => 'Command',
                'attribute' => 'Presence',
                'description' => 'Leading others with authority and confidence.',
            ],
            [
                'name' => 'Performance',
                'attribute' => 'Presence',
                'description' => 'Captivating an audience through artistic expression.',
            ],
            [
                'name' => 'Inspiration',
                'attribute' => 'Presence',
                'description' => 'Motivating others to act with courage and determination.',
            ],
            [
                'name' => 'Diplomacy',
                'attribute' => 'Presence',
                'description' => 'Negotiating and resolving conflicts peacefully.',
            ],
            
            // Might skills
            [
                'name' => 'Breaking',
                'attribute' => 'Might',
                'description' => 'Destroying objects and barriers with physical force.',
            ],
            [
                'name' => 'Close Combat',
                'attribute' => 'Might',
                'description' => 'Fighting effectively in hand-to-hand combat.',
            ],
            [
                'name' => 'Endurance',
                'attribute' => 'Might',
                'description' => 'Withstanding physical hardship and exertion.',
            ],
            [
                'name' => 'Lifting',
                'attribute' => 'Might',
                'description' => 'Moving heavy objects and feats of raw physical strength.',
            ],
        ];

        foreach ($skills as $skill) {
            MagicalSkill::create($skill);
        }
    }
}