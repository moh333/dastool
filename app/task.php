<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    public $timestamps  = false;
    
    protected $fillable = [
        'board','title','suspensed','deleted','created_at'
    ];

    protected $hidden = [
        'board','suspensed','deleted','created_at'
    ];
    
    public function Assignments(){
        return $this->hasMany('App\assignment','task','id');
    }
}

