<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    protected  $guarded = [];
    CONST FIRST_CHAR = '/';

    public function currentQuestion()
    {
        return $this->belongsTo(Question::class,'current_question_id','id');
    }

    public static  function firtsQuestionId()
    {
        return 2;
    }

    public function getNextQuestion()
    {
        return Question::find( ($this->current_question_id + 1) );
    }

}
