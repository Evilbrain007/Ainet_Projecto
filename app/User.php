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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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

}
