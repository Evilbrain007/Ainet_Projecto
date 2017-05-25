<?php

namespace App\Http\Controllers;

use App\Comment;
use App\PrintRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required|max:255',
            'requestId' => 'required']);
        //inicializamos o array de atributos requestId e comment e vamos buscar esses campos atraves do input
        $attributes = ['request_id' => $request->input('requestId'),
            'user_id' => Auth::id(),
            'comment' => $request->input('comment')];

        $comment = Comment::create($attributes);
        Comment::store($comment);

        return redirect()->route('request.details', ['id' => $request->input('requestId')]);
    }

    public function storeReply(Request $request){

        $this->validate($request, [
            'comment' => 'required|max:255',
            'parent' => 'required',
            'requestId' => 'required']);

        $parentRequest = Comment::find($request->input('parent'));
        if($parentRequest->getAttribute('request_id')!=$request->input('requestId')){
            $message = ['message_error' => 'O comentário que quer responder tem de ter o mesmo Pedido'];
            return redirect(route('request.details', ['id' => $request->input('requestId')]))->with($message);
        }

        $attributes = ['request_id' => $request->input('requestId'),
            'user_id' => Auth::id(),
            'parent_id' => $request->input('parent'),
            'comment' => $request->input('comment')];

        $comment = Comment::create($attributes);
        Comment::store($comment);

        return redirect()->route('request.details', ['id' => $request->input('requestId')]);
    }

    public function block(Comment $id)
    {
        $comment = $id;
        $comment->blocked = true;
        if ($comment->save()) {
            $message = ['message_success' => 'Comentário #'.$comment->id.'bloqueado.'];
            return redirect()->back()->with($message);
        }
        $message = ['message_error' => 'Erro. Comentário #'.$comment->id.'não pode ser bloqueado.'];
        return redirect()->back()->with($message);
    }

}
