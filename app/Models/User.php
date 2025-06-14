<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Norāda, ka timestamps ir aktīvs
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Atribūti, kurus drīkst masveidā aizpildīt.
     *
     * @var array<int, 
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'banned_at',
    ];

    /**
     * Atribūti, kuri tiks paslēpti.
     *
     * @var array<int, 
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Automātiski pārvēršamie atribūti.
     *
     * @var array<string, 
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'banned_at' => 'datetime',
    ];

    
    public function isBanned()
    {
        return $this->banned_at !== null;
    }

    
    public function isAdmin()
    {
        return $this->is_admin === 1;
    }

   
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
