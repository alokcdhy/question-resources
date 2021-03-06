<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use  Illuminate\Support\Str;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //    get user related questions
    public function questions(){
        return $this->hasMany(Question::class);
    }
    //    generate question url
    public function getUrlAttribute(){
//        return route("questions.show",$this->id);
        return "javascript:;";
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }
    // body
    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body);
    }
}
