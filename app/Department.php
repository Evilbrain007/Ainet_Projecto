<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departaments';

    public function user()
    {
        return $this->hasMany('App\User');
    }

}
