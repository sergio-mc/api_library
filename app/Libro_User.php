<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro_User extends Model
{
    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function libro()
    {
        return $this->hasOne('App\Libro','id','libro_id');
    }
}
