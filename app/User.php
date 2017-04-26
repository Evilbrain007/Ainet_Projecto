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

    private $id;
    private $name;
    private $email;
    private $password;
    private $rembember_token;
    private $admin;//boolean
    private $blocked;//boolean
    private $phone;//string
    private $profile_photo;
    private $profile_url;
    private $presentation;
    private $print_evals;
    private $print_counts;
    private $department_id;

    public static function create($attributes)
    {
        $name = $attributes['name'];
        $email = $attributes['email'];
        $password= $attributes['password'];
        $rembember_token = null;
        $admin = false;
        $blocked = false;
        $phone = $attributes['phone'];
        $profile_photo = null;
        $profile_url = "";
        $presentation = "";
        $print_evals = 0;
        $print_counts = 0;
        $department_id = $attributes['department_id'];
    }

    public static function store($user)
    {
        $user->save();
    }

}
