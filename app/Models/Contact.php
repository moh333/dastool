<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps  = false;
    
    protected $fillable = [
       'user_id','firstname','lastname','email','phone','dob','companyname','gender','salutation','created_at'
    ];

    protected $hidden = [
        'user_id','created_at','updated_at'
    ];
    
    public function contactaddress(){
        return $this->hasOne('App\Models\Contact_address','contact_id','id');
    }

    public function contactsocialmedia(){
        return $this->hasOne('App\Models\Contact_socialmedia','contact_id','id');
    }

    public function contactmiscellaneous(){
        return $this->hasOne('App\Models\Contact_miscellaneous','contact_id','id');
    }
}

