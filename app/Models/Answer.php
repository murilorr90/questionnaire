<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'question_id', 'next_question_id', ];

    protected $hidden = ['created_at', 'updated_at'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function nextQuestion()
    {
        return $this->belongsTo(Question::class);
    }

    public function productExclusions()
    {
        return $this->hasMany(ProductExclusion::class);
    }
}
