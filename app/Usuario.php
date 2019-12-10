<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public function libro()
    {
        return $this->belongsTo('App\Libro');
    }
}
