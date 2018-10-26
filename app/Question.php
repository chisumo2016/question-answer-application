<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //

    protected $fillable = ['title', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Mutator
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);

    }

    //Accessor

    public function getUrlAttribute()
    {
        return route("questions.show", $this->slug);  //$this->id
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    //accessor

    public function getStatusAttribute()
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    public function getDescriptionHtmlAttribute()
    {
        //external libray
        return \Parsedown::instance()->text($this->description);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
        //$question->answers()->count() problem
        //foreach ($question->answers as $answer)
    }
}
