<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function printRequest()
    {
        return $this ->belongsTo('App\PrintRequest');
    }

    public function parent()
    {
        return $this->hasMany('App\Comment');
    }

    public function reply()
    {
        return $this->belongsTo('App\Comment', 'parent_id');
    }
}
