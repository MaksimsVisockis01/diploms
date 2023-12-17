<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $attributes = [
        //
    ];

    protected $fillable = [
        'user_id','title', 'author', 'description', 'file_path', 'published_at',
    ];

    
    protected $hidden = [
        'user_id','file_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
