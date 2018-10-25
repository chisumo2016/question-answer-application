<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //

    protected  $fillable = ['title', 'description'];

    public  function  user()
    {
        return $this->belongsTo(User::class);
    }

    //Mutator
    public  function  setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);

    }

    //Accessor

    public  function  getUrlAttribute()
    {
        return route("questions.show", $this->id);
    }

    public function  getCreatedDateAttribute()
    {
       return $this->created_at->diffForHumans();
    }
}
