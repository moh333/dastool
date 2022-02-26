<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public $timestamps  = false;
    
    protected $fillable = [
       'user_id','title','suspensed','deleted','created_at'
    ];

    protected $hidden = [
        'user_id','suspensed','deleted','created_at','updated_at'
    ];
    
    public function Tasks(){
        return $this->hasMany('App\Models\Task','board','id');
    }
}

