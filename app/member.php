<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class member extends Authenticatable
{
    use HasApiTokens, Notifiable;
    public $timestamps = false;

    protected $fillable = [
        'name','email','password','firebase_token','forgetcode','registercode','activate','suspensed','deleted','created_at'
    ];

    protected $hidden = [
        'password','remember_token','firebase_token','forgetcode','registercode','activate','suspensed','deleted','created_at'
    ];
    
}

