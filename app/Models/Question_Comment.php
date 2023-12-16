<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question_Comment extends Model
{
    use HasFactory;
    protected $attributes = [
        //
    ];

    protected $fillable = [
        'user_id','question_id', 'text','published_at',
    ];

    
    protected $hidden = [
        'user_id','question_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
