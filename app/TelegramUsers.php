<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelegramUsers extends Model
{
    //
    protected $guarded = [];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class,'telegram_user_id','id');
    }

    public function lastQuiz()
    {
        return $this->hasOne(Quiz::class,'telegram_user_id','id')
            ->orderBy('quizzes.id', 'desc')
            ->limit(1);
    }
}
