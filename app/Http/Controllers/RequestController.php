<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrintRequest;
use App\Comment;

class RequestController extends Controller
{
    public function create()
    {
        $title = 'Criar Pedido';

        return view('requests/create', compact('title'));
    }

    public function store()
    {

    }

    public function details()
    {
        $title = 'Detalhes do produto';

        return view('requests/details', compact('title'));
    }

    public function dashboard()
    {
        $title = 'Pedidos';
        $owner_id = 1;

        $requests = PrintRequest::where('owner_id', $owner_id)->get();
        $comments = [];
        $replys = [];

        foreach ($requests as $request){
           $aux = Comment::where('request_id', $request->id)->get();
           foreach ($aux as $comment){
               $numberReplies = Comment::where('parent_id', $comment->id)->count();
               if (!isset($comment->parent_id)){
                   $comment['numberReplies'] = $numberReplies;
                   $comments [] = $comment;
               }

           }
        }


        //dd($comments);

        return view('requests/dashboard', compact('title', 'requests', 'comments'));
    }
}
