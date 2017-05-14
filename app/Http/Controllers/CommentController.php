<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        //inicializamos o array de atributos requestId e comment e vamos buscar esses campos atraves do input
        $attributes = ['request_id' => $request->input('requestId'),
            'user_id' => Auth::id(),
            'comment' => $request->input('comment')];

        $comment = Comment::create($attributes);
        Comment::store($comment);

        return redirect()->route('requestDetails', ['id' => $request->input('requestId')]);
    }

    public function storeReply(Request $request){

        $attributes = ['request_id' => $request->input('requestId'),
            'user_id' => Auth::id(),
            'parent_id' => $request->input('parent'),
            'comment' => $request->input('comment')];

        $comment = Comment::create($attributes);
        Comment::store($comment);

        return redirect()->route('requestDetails', ['id' => $request->input('requestId')]);
    }

}
