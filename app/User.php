<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'department_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'admin', 'blocked', 'print_evals', 'print_counts'
    ];

    public static function create($attributes)
    {
        $user = new User();
        $user->name = $attributes['name'];
        $user->email = $attributes['email'];
        $user->password = $attributes['password'];
        $user->admin = false;
        $user->blocked = false;
        $user->phone = $attributes['phone'];
        $user->print_evals = 0;
        $user->print_counts = 0;
        $department = Department::find($attributes['department_id']);
        $user->department()->associate($department);
        return $user;
    }

    public static function store(User $user)
    {
        $user->save();
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function printRequest()
    {
        return $this ->hasMany('App\PrintRequest');
    }

}