<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contact_miscellaneous extends Model
{
    public $timestamps  = false;
    
    protected $fillable = [
       'contact_id','firstcontact','customernumber','weddingdate','commonsurname','knownby','language','publication_rights','created_at'
    ];

    protected $hidden = [
        'contact_id','created_at','updated_at'
    ];
    
}

