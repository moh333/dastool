<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class assignment extends Model
{
    public $timestamps  = false;
    
    protected $fillable = [
        'task','title','description','suspensed','deleted','created_at'
    ];

    protected $hidden = [
        'task','suspensed','deleted','created_at'
    ];
}

