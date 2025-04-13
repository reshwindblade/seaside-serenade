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
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'provider',
        'provider_id',
        'avatar',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Check if the user has a social login provider
     */
    public function hasSocialLogin(): bool
    {
        return !empty($this->provider);
    }

    /**
     * Check if the user has a traditional password login
     */
    public function hasPasswordLogin(): bool
    {
        return !empty($this->password);
    }

    /**
     * Check if the user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Get the characters created by this user
     */
    public function characters()
    {
        return $this->hasMany(Character::class, 'player_name', 'name');
    }

    /**
     * Get the recaps created by this user
     */
    public function recaps()
    {
        return $this->hasMany(Recap::class, 'created_by');
    }
}