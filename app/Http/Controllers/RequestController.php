<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\PrintRequest;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    public function create()
    {
        $title = 'Criar Pedido';
        $printRequest = new PrintRequest();


        return view('requests/create', compact('title', 'printRequest'));
    }

    public function store(Request $request)
    {
        //dd($request);
        //$request->input('description');
        $path = $request->file('file')->store('requestFiles');


        $attributes = ['owner_id' => 1, //TODO WHEN CONTROL AUTH IS DONE
            'status' => 0,
            'open_date' => Carbon::now(),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'paper_type' => $request->input('paper_type'),
            'colored' => $request->input('colored'),
            'stapled' => $request->input('stapled'),
            'paper_size' => $request->input('paper_size')[1],
            'file'=> $path];
        if($request->exists('due_date')){
            $attributes ['due_date'] =  $request->input('due_date');
        }


        $printRequest = PrintRequest::create($attributes);
        PrintRequest::store($printRequest);

        return redirect()->route('requestsDashboard');
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
