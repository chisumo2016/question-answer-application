<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected  $fillable =[ 'description', 'user_id'];
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
            //$answer->question->save();
            ///echo "Answer Createad\n";
        });

        static::deleted(function ($answer){

            $answer->question->decrement('answers_count');
//            $question = $answer->question;
//            $answer->question->decrement('answers_count');

//            if($question->best_answer_id == $answer->id){
//                $question->best_answer_id = NULL;
//
//                $question->save();
//            }
        });

//        static::saved(function ($answer){
//            echo "Answer  Saved\n";
//        });
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        return $this->id == $this->question->best_answer_id ? 'vote-accepted' : '';
    }





}
