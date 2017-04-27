<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    public function printRequest()
    {
        $this->hasMany('App\PrintRequest');
    }
}
