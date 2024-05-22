<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $attributes = [
        'active' => true,
        'admin' => false,
    ];

    protected $fillable = [
        'name', 'email', 'avatar','uid',

        'active','password',

        'admin',
    ];

    
    protected $hidden = [
        'password',
        '_token',
    ];

    public function isAdmin()
    {
        return $this->admin;
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function comments()
    {
        return $this->hasMany(Question_Comment::class);
    }
}
