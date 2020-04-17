<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    //    mass assignment
    protected $fillable=['title','body'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    //    set slug attribute
    public  function setTitleAttribute($value){
        $this->attributes['title']=$value;
        $this->attributes['slug']=Str::slug($value);
    }
    //    generate question url
    public function getUrlAttribute(){
        return route("questions.show",$this->id);
    }
    // get created date
    public  function  getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }
}
