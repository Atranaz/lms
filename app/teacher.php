<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'subject', 'password',
    ];

    public function classes()
    {
        return $this->belongsToMany('App\Mclass');
    }
}
