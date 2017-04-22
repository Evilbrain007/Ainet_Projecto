<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    private $id;
    private $comment;//string
    private $blocked;//boolean
    private $request_id;
    private $user_id;
}
