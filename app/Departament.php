<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    private $name;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
