<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function printRequest()
    {
        return $this ->belongsTo('App\PrintRequest', 'request_id');
    }

    public function parent()
    {
        return $this->hasMany('App\Comment');
    }

    public function reply()
    {
        return $this->belongsTo('App\Comment', 'parent_id');
    }

    public static function create($attributes)
    {
        $comment = new Comment();
        $printRequest = PrintRequest::find($attributes['requestId']); //vamos buscar o id do pedido
        $comment->printRequest()->associate($printRequest);
        // associamos o comentario ao pedido
        //usando o metodo printRequest desta classe, que tem o belongsTo

        //tb temos que associar o user que escreveu o comentario ao comantario
        $user = User::find(Auth::id()); //vamos buscar o id do user
        $comment->user()->associate($user);

        //por o valor da mensagem na coluna comment usa metodo setAttribute que recebe o noem da coluna comment
        //e o valor da msg que chamámos comment
        $comment->setAttribute('comment', $attributes['comment']);
        $comment->setAttribute('blocked', 0); //temos k definir que por default o comantario nao esta bloqueado



        return $comment;
    }

    public static function store($comment)
    {
        //guardar o comentario na base de dadso
        $comment->save();
    }
}
