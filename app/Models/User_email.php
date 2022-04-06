<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User_email extends Model
{
    public $timestamps  = false;
    
    protected $fillable = [
        'user_id','name','to','subject','message','archived','readed','deleted','created_at'
    ];

    protected $hidden = [
        'user_id','deleted','created_at'
    ];
}

