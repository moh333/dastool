<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class wallet extends Model
{
    public $timestamps  = false;
    
    protected $fillable = [
        'user_id','bank','name','card_number','expired_date','suspensed','deleted','created_at'
    ];

    protected $hidden = [
        'user_id','suspensed','deleted','created_at'
    ];
}

