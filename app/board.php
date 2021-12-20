<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class board extends Model
{
    public $timestamps  = false;
    
    protected $fillable = [
       'user_id','title','suspensed','deleted','created_at'
    ];

    protected $hidden = [
        'user_id','suspensed','deleted'
    ];
    
    public function Tasks(){
        return $this->hasMany('App\task','board','id');
    }
}

