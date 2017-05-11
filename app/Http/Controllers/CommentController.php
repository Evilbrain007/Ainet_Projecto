<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        //inicializamos o array de atributos requestId e comment e vamos buscar esses campos atraves do input
        $attributes = ['requestId'=>$request->input('requestId'), 'comment'=>$request->input('comment')];

       $comment = Comment::create($attributes);
       Comment::store($comment);

       return redirect()->route('requestDetails', ['id' => $request->input('requestId')]);
    }

}
