<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    public function printRequest()
    {
        return $this->hasMany('App\PrintRequest');
    }
}
