<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $table = 'password_resets';
    protected $primaryKey = 'email';

}
