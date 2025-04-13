<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorldSetting extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'world_settings';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'last_updated_by',
    ];

    /**
     * Get the user that last updated the world setting.
     */
    public function lastUpdatedBy()
    {
        return $this->belongsTo(User::class, 'last_updated_by');
    }

    /**
     * Get the single world setting instance.
     */
    public static function getSetting()
    {
        return self::firstOrCreate([
            'id' => 1
        ], [
            'content' => '# Welcome to the Cyberpunk World

            This is the default world setting page. An admin can edit this content to provide information about the world setting of the RPG campaign.

            ## History

            ## Locations

            ## Factions

            ## Technology

            ## Social Structure
            ',
            'last_updated_by' => null,
        ]);
    }
}