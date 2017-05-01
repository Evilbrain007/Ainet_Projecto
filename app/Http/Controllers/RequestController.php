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
        $printRequest = new PrintRequest();


        return view('requests/create', compact('title', 'printRequest'));
    }

    public function store()
    {

    }

    /*public function details($id)
    {
        $title = 'Detalhes do produto';
        $printRequest = PrintRequest::find($id);

        return view('requests/details', compact('title', 'printRequest'));
    }*/


    public function details(PrintRequest $id)//O ID vai ser transformado no respectivo PrintRequest, se existir
    {
        $title = 'Detalhes do produto';

        $printRequest = $id;

        return view('requests/details', compact('title', 'printRequest'));
    }

    public function edit(PrintRequest $id)
    {
        $printRequest = $id;
        $title = "Editar pedido nº $printRequest->id"; //isto esta bem? ou evia so buscar o id na vista blade?

        return view('requests/create', compact('title', 'printRequest'));
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

    public function createComment()
    {

    }
}
