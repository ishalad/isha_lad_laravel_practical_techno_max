<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'password',
        'phone',
        'email_verified_at',
        'reference',
        'technology_ids',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($client) {
            event(new \App\Events\ClientRegister($client));
        });
    }

    public function firstName(): Attribute
    {
        return Attribute::make(get: fn () => explode(' ', $this->name)[0]);
    }

    public function lastName(): Attribute
    {
        return Attribute::make(get: fn () => explode(' ', $this->name)[1]);
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'technology_user');
    }

}
