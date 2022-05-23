<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contact_address extends Model
{
    public $timestamps  = false;
    
    protected $fillable = [
       'contact_id','country','city','street','postalcode','created_at'
    ];

    protected $hidden = [
        'contact_id','created_at','updated_at'
    ];
    
}

