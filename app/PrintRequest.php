<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintRequest extends Model
{
    protected $table = 'requests';

    public function comment()
    {
        $this->hasMany('App\Comment');
    }

    public function printer()
    {
        $this->belongsTo('App\Printer');
    }

    public function owner() {
        $this->belongsTo('App\User', 'owner_id');
    }

    public function closingUser() {
        $this->belongsTo('App\User', 'closed_user_id');
    }

    protected $fillable = [
        'owner_id', 'status', 'open_date', 'file', 'description', 'due_date', 'quantity', 'paper_type', 'colored', 'stapled', 'paper_size',
    ];
}
