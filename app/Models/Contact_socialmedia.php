<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contact_socialmedia extends Model
{
    public $timestamps  = false;
    
    protected $fillable = [
       'contact_id','facebook','instagram','youtube','twitter','linkedin','website','created_at'
    ];

    protected $hidden = [
        'contact_id','created_at','updated_at'
    ];
    
}

