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
        'user_id','title', 'content','published_at',
    ];

    
    protected $hidden = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Question_Comment::class, 'question_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_question');
    }

}
