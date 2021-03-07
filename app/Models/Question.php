<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'question', 'answer1', 'answer2', 'answer3', 'answer4', 'correct_answer',];
    protected $appends = ['TruePercent'];

    public function myAnswer()
    {

        return $this->hasMany(Answers::class)->where('user_id', auth()->user()->id);
    }

    public function getTruePercentAttribute()
    {
        $answer_count = $this->answers()->count();
        $true_answer = $this->answers()->where('answer', $this->correct_answer)->count();
        return round((100 / $answer_count) * $true_answer);
    }

    public function answers()
    {
        return $this->hasMany(Answers::class);
    }

}
