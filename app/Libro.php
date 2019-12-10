<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User','libro__users');
    }
}
