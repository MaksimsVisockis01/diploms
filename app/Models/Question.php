<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $attributes = [
        //
    ];

    protected $fillable = [
        'user_id','title', 'content',
    ];

    
    protected $hidden = [
        'user_id',
    ];

}
