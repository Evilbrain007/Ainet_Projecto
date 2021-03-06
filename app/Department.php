<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    private $totalPrints;

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
