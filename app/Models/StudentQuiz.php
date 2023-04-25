<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuiz extends Model
{
    use HasFactory;
    public function questions()
    {
        return $this->hasMany(QuizQuestionAttemp::class,'quiz_id','id');
    }
}
