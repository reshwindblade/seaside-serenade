<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rule;
use App\Models\Npc;
use App\Models\Character;
use App\Models\WorldSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@cyberpunk.com',
            'password' => Hash::make('cyberpunkadmin'),
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);
        
        // Create regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@cyberpunk.com',
            'password' => Hash::make('cyberpunkadmin'),
            'email_verified_at' => now(),
            'is_admin' => false,
        ]);
        
        // Create default world setting
        WorldSetting::create([
            'id' => 1,
            'content' => $this->getDefaultWorldSetting(),
        ]);
        
        // Create some example rules
        $this->createExampleRules();
        
        // Create some example NPCs
        $this->createExampleNpcs();
        
        // Create some example characters
        $this->createExampleCharacters();
    }
    
    private function getDefaultWorldSetting(): string
    {
        return <<<'MARKDOWN'
# Welcome to Night City

Night City is a megalopolis in the Free State of Northern California, controlled by corporations and rife with gang warfare and corruption. It is a world of extreme violence and technology, where implants, drugs, and virtual reality blur the lines between human and machine, reality and illusion.

## History

Founded in 1994 by corporate tycoon Richard Night, Night City was designed to be a utopian metropolis free from crime and poverty. After Night's assassination, the city fell into decay, and control was seized by megacorporations. 

A series of conflicts known as the Corporate Wars ravaged the global economy, leading to the collapse of the United States government and the rise of corporate-controlled city-states like Night City.

## Locations

### Corporate Plaza
The gleaming center of corporate power, home to massive arcologies and corporate headquarters. The streets are clean, the security is tight, and everything is under constant surveillance.

### Watson
A formerly corporate district that has fallen on hard times. Now it's a crowded, multicultural neighborhood with a mix of old corporate architecture and new, improvised structures.

### Pacifica
Once intended to be a tourist resort, Pacifica was abandoned during construction when the economy collapsed. Now it's a lawless zone controlled by gangs, with half-finished buildings serving as makeshift homes and fortresses.

### The Combat Zone
The most dangerous part of the city, where law enforcement doesn't even bother to patrol. Gang warfare is constant, and only the most desperate or dangerous individuals live here.

## Factions

### Megacorporations
- **Arasaka**: Japanese megacorp specializing in security, banking, and manufacturing
- **Militech**: American weapons manufacturer and private military contractor
- **Biotechnica**: Leading biotech and genetic engineering corporation
- **Netwatch**: Global network security agency

### Gangs
- **Maelstrom**: Cybernetics-obsessed gang known for extreme body modification
- **Tyger Claws**: Traditional Japanese gang with a focus on martial arts and honor
- **Voodoo Boys**: Mysterious netrunners operating from Pacifica
- **Animals**: Muscle-focused gang that abhors cyberware in favor of biochemical enhancement

## Technology

Night City is a playground of advanced technology: 
- **Cyberware**: Technological implants ranging from simple subdermal chips to full limb replacements
- **Netrunning**: The ability to directly interface with the NET using a cyberdeck and specialized implants
- **Smart Weapons**: Firearms with targeting computers, tracking bullets, and other enhancements
- **Braindance**: Technology that allows users to experience recorded memories, including sensations

## Social Structure

At the top sit the corporate executives, living in ultra-luxury high above the city. Below them are the corporate employees, enjoying relative comfort and security. The middle class consists of small business owners, skilled freelancers, and high-ranking gang members. 

The majority of Night City's population falls into the lower class, struggling to make ends meet through legitimate or illegitimate means. At the bottom are the homeless and destitute, fighting daily for survival in the city's most dangerous districts.
MARKDOWN;
    }
    
    private function createExampleRules(): void
    {
        $rules = [
            [
                'name' => 'Character Creation',
                'category' => 'Core Rules',
                'description' => '
# Character Creation

Creating a character in our Cyberpunk RPG involves several steps:

1. **Choose a Role**: Each role has unique abilities and skills.
   - Solo (Combat specialist)
   - Netrunner (Hacker)
   - Techie (Technical specialist)
   - Medtech (Medical specialist)
   - Media (Journalist)
   - Rockerboy (Charismatic performer)
   - Corporate (Business executive)
   - Fixer (Dealer/smuggler)
   - Nomad (Outsider/traveler)

2. **Assign Statistics**: Distribute points among your basic attributes:
   - INT (Intelligence)
   - REF (Reflexes)
   - TECH (Technical ability)
   - COOL (Self-control)
   - ATTR (Attractiveness)
   - LUCK (Fortune)
   - MA (Movement ability)
   - BODY (Physical capability)
   - EMP (Empathy)

3. **Select Skills**: Each character has skills based on their role and personal choices.

4. **Choose Cyberware**: Select technological enhancements that fit your character\'s concept.

5. **Define Background**: Create a personal history, connections, and motivations for your character.
                ',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Combat Basics',
                'category' => 'Core Rules',
                'description' => '
# Combat Basics

Combat in our Cyberpunk RPG is fast, lethal, and tactical.

## Turn Order
1. **Initiative**: Roll 1d10 + REF + applicable modifiers to determine turn order.
2. **Actions**: On your turn, you can move and take one action.
3. **Reactions**: Some abilities allow you to react to events outside your turn.

## Attack Resolution
1. **Attack Roll**: Roll 1d10 + Applicable skill + Attribute + Modifiers
2. **Defense**: Target\'s applicable defense value
3. **Damage**: If attack is successful, roll weapon damage and subtract armor

## Critical Events
- **Critical Success**: Natural 10 on attack roll doubles damage
- **Critical Failure**: Natural 1 on attack roll causes weapon jam or fumble

## Cover and Concealment
- **Partial Cover**: +2 to defense
- **Full Cover**: Cannot be targeted directly
                ',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Netrunning',
                'category' => 'Special Rules',
                'description' => '
# Netrunning

Netrunning is the art of navigating the digital realm in our Cyberpunk RPG.

## Requirements
- Netrunner role or Netrunning skill
- Cyberdeck hardware
- Interface plugs (cyberware)

## Actions
- **Jack In**: Connect to a network
- **Scan**: Identify systems and ICE (Intrusion Countermeasures Electronics)
- **Attack**: Attempt to damage or bypass ICE
- **Control**: Take over a system once defenses are bypassed
- **Download/Upload**: Transfer data

## Dangers
- **Black ICE**: Defensive programs that can cause real brain damage
- **Tracing**: Security systems attempting to locate you physically
- **Data Corruption**: Loss of programs or information
                ',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Cyberware',
                'category' => 'Equipment',
                'description' => '
# Cyberware

Cyberware represents the technological implants and body modifications available in our Cyberpunk RPG.

## Humanity Cost
Each piece of cyberware reduces your Empathy attribute slightly, representing the disconnection from your humanity. If Empathy reaches 0, the character becomes a cyber-psycho and is removed from play.

## Common Types
- **Cyberlimbs**: Replacement arms and legs with enhanced strength and hidden capabilities
- **Neural Implants**: Brain modifications for faster processing, memory enhancement, or skill chips
- **Optical Implants**: Enhanced vision, recording capabilities, targeting systems
- **Audio Implants**: Enhanced hearing, sound filtering, recording capabilities
- **Internal Systems**: Enhanced organs, subdermal armor, toxin filters

## Installation
Cyberware must be installed by a qualified ripperdoc. The quality of installation affects recovery time and potential complications.
                ',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Reputation',
                'category' => 'Social Rules',
                'description' => '
# Reputation

In Night City, who you know and what people think of you can be as important as your skills or your weapons.

## Reputation Score
- Ranges from 1-10
- Represents how well-known and respected you are in certain circles
- Different factions may have different reputation scores for the same character

## Benefits
- Higher prices when selling goods or services
- Discounts when buying from allies
- Access to restricted areas or information
- Backup in dangerous situations
- Better job offers

## Risks
- Being targeted by rivals
- Unwanted attention from law enforcement
- Expectations to maintain status

## Gaining and Losing Reputation
- Successful high-profile jobs increase reputation
- Failing jobs or betraying allies decreases reputation
- Reputation naturally decays over time if not maintained
                ',
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($rules as $rule) {
            Rule::create($rule);
        }
    }
    
    private function createExampleNpcs(): void
    {
        $npcs = [
            [
                'name' => 'Johnny Silverhand',
                'title' => 'Legendary Rockerboy',
                'description' => '
# Johnny Silverhand

Johnny Silverhand is a legendary rockerboy and anti-corporate terrorist who disappeared decades ago after a failed attack on Arasaka Tower. Known for his charismatic stage presence, scathing corporate criticism, and silver cybernetic arm, Johnny was the lead singer and guitarist of the iconic band Samurai.

## Background

Born Robert John Linder, Johnny served in the Second Central American Conflict before deserting and reinventing himself as Johnny Silverhand. After his girlfriend Alt Cunningham was kidnapped by Arasaka, Johnny harbored an intense hatred for the corporation, culminating in multiple terrorist attacks against them.

## Personality

Johnny is charismatic, passionate, and intensely anti-corporate. He\'s also selfish, impulsive, and destructive. He values personal freedom above all else and believes the only good corporation is a dead corporation.

## Appearance

Tall and lean with long dark hair, Johnny is instantly recognizable by his reflective silver cybernetic left arm and his signature aviator sunglasses. He dresses in punk rock fashion with leather pants, combat boots, and often a kevlar-lined jacket adorned with band logos.
                ',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Rogue Amendiares',
                'title' => 'Fixer Queen of the Afterlife',
                'description' => '
# Rogue Amendiares

Rogue Amendiares is the most powerful fixer in Night City and proprietor of the legendary Afterlife bar. With decades of experience first as a solo and later as a fixer, Rogue has connections to every major player in the city.

## Background

Starting as a solo in the 2020s, Rogue ran with Johnny Silverhand and his crew before establishing herself as a fixer. Over the decades, she built an unparalleled network of contacts and a reputation for professionalism and reliability that has made her the top fixer in Night City.

## Personality

Rogue is cool, calculating, and professional. She values competence and reliability above all else. While not sentimental, she maintains a complex relationship with her past and the ideals of her youth.

## Influence

From her seat at the Afterlife, Rogue controls much of Night City\'s underground economy. She connects clients with mercenaries, brokers deals between corporations and streetgangs, and generally keeps her finger on the pulse of the city. Crossing Rogue is considered career suicide for any mercenary in Night City.
                ',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Saburo Arasaka',
                'title' => 'Emperor of Arasaka Corporation',
                'description' => '
# Saburo Arasaka

Saburo Arasaka is the ancient, ruthless founder and CEO of the Arasaka Corporation, one of the most powerful megacorporations in the world.

## Background

Born in 1919 in Japan, Saburo was a former Imperial Japanese Navy pilot during World War II. After Japan\'s defeat, he built Arasaka from a small security company into a global megacorporation specializing in banking, manufacturing, and security services.

## Personality

Saburo is cold, calculating, and utterly ruthless. He has an unwavering belief in his own superiority and divine right to rule. He holds traditional Japanese values and harbors a deep resentment toward the United States for Japan\'s defeat in WWII.

## Appearance

Despite being over 150 years old thanks to life-extending technology, Saburo maintains the appearance of an elderly but imposing Japanese man. He often wears traditional Japanese clothing or immaculate business suits.

## Influence

As the head of Arasaka, Saburo controls one of the most powerful military and economic forces on the planet. His word is law within the corporation, and his influence extends into governments worldwide.
                ',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($npcs as $npc) {
            Npc::create($npc);
        }
    }
    
    private function createExampleCharacters(): void
    {
        $characters = [
            [
                'name' => 'V',
                'player_name' => 'Player Character',
                'description' => '
# V

V is a mercenary navigating the crime-ridden streets of Night City in 2077. With a reputation as a skilled and reliable operator, V takes on dangerous jobs for fixers, corporations, and individuals with the means to pay.

## Background

Originally from either a Nomad clan, the City streets, or a Corporate background, V came to Night City seeking fortune and glory. After partnering with Jackie Welles for a time, a catastrophic heist has changed V\'s life forever.

## Skills & Abilities

V is adaptable, with capabilities that can emphasize combat prowess, technical expertise, or social manipulation depending on their specialization. Regardless of build, V is a formidable operator with extensive cybernetic enhancements.

## Goals

Survival and making a name in Night City drive V forward. Whether seeking to become a legend of the Afterlife or simply to accumulate enough wealth to escape the city\'s clutches, V is determined to leave a mark on this world.
                ',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Jackie Welles',
                'player_name' => 'Side Character',
                'description' => '
# Jackie Welles

Jackie Welles is a charismatic mercenary and V\'s closest friend in Night City. Born and raised in Heywood, Jackie has strong ties to his community and dreams of making it to the big leagues.

## Background

Former member of the Valentinos gang, Jackie left that life behind to become a freelance mercenary. He maintains close ties with his mother Guadalupe and his girlfriend Misty Olszewski.

## Personality

Jackie is boisterous, loyal, and ambitious. He dreams of becoming a legend in Night City and enjoying all the luxuries that come with success. Despite his tough exterior, Jackie values family and friendship above all else.

## Skills & Abilities

Jackie specializes in close combat and firearms. His imposing physical presence and street smarts make him an invaluable ally in dangerous situations. While not the most subtle operator, his straightforward approach has gotten him out of many tight spots.
                ',
                'is_active' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($characters as $character) {
            Character::create($character);
        }
    }
}