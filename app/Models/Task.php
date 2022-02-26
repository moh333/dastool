<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $timestamps  = false;
    
    protected $fillable = [
        'board','title','suspensed','deleted','created_at'
    ];

    protected $hidden = [
        'board','suspensed','deleted','created_at','updated_at'
    ];
    
    public function Assignments(){
        return $this->hasMany('App\Models\Assignment','task','id');
    }
}

