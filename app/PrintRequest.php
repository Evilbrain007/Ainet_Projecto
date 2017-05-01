<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PrintRequest extends Model
{
    protected $table = 'requests';

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function printer()
    {
        return $this->belongsTo('App\Printer');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

    public function closingUser()
    {
        return $this->belongsTo('App\User', 'closed_user_id');
    }

    public static function create($attributes)
    {
        $printRequest = new PrintRequest();

        $user = User::find(Auth::id());
        $printRequest->owner()->associate($user);

        foreach ($attributes as $key => $value){
            $printRequest->setAttribute($key, $value);
        }

        return $printRequest;

    }

    public static function store($printRequest){
        $printRequest->save();
    }


    protected $fillable = [
        'owner_id', 'status', 'open_date', 'file', 'description', 'due_date', 'quantity', 'paper_type', 'colored', 'stapled', 'paper_size',
    ];
}
