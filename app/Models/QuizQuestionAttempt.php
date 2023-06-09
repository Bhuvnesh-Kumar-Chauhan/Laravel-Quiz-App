<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestionAttempt extends Model
{
    use HasFactory;
    public function quizes():HasOne
    {
        return $this->belongsTo(StudentQuiz::class);
    }
}
