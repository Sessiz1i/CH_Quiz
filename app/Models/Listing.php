<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable=['quiz_id','question_id'];
    public $timestamps =false;

    public function quizList()
    {
        return $this->hasMany(Quiz::class,'id','quiz_id');
    }

    public function questionList()
    {
        return $this->hasOne(Question::class,'id','question_id');
    }
    public function myAnswer()
    {
        return $this->hasOne(Answers::class,'question_id','question_id')->where('user_id', auth()->user()->id);
    }

}
