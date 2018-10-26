<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public  function  question()
    {
        return $this->belongsTo(Question::class);
    }

    public  function  user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDescriptionHtmlAttribute()
    {
        //external libray
        return \Parsedown::instance()->text($this->description);
    }

    public static function  boot()
    {
        parent::boot();

        static::created(function ($answer){

            $answer->question->increment('answers_count');
            $answer->question->save();
            ///echo "Answer Createad\n";
        });

//        static::saved(function ($answer){
//            echo "Answer  Saved\n";
//        });
    }


}
