<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    /**
     * Check if the user has a traditional password login
     */
    public function hasPasswordLogin(): bool
    {
        return !empty($this->password);
    }
    
    /**
     * Get the magical girl characters associated with the user.
     */
    public function magicalGirls()
    {
        return $this->hasMany(MagicalGirl::class);
    }
    
    /**
     * Get the user's primary magical girl character.
     * This maintains compatibility with existing code.
     */
    public function magicalGirl()
    {
        return $this->hasOne(MagicalGirl::class)->orderBy('created_at', 'asc');
    }
    
    /**
     * Check if the user has created any magical girl characters.
     */
    public function hasMagicalGirl(): bool
    {
        return $this->magicalGirls()->exists();
    }
    
    /**
     * Get the count of magical girls the user has created.
     */
    public function magicalGirlsCount(): int
    {
        return $this->magicalGirls()->count();
    }
}