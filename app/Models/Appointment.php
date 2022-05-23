<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public $timestamps  = false;
    
    protected $fillable = [
       'contact_id','reference','start_date','end_date','location','note','created_at'
    ];

    protected $hidden = [
        'contact_id','created_at','updated_at'
    ];
    
}

