<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    public $timestamps  = false;
    
    protected $fillable = [
        'task','title','description','suspensed','deleted','created_at'
    ];

    protected $hidden = [
        'task','suspensed','deleted','created_at'
    ];
}

