<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\PrintRequest;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    public function create()
    {
        $title = 'Criar Pedido';

        return view('requests/create', compact('title'));
    }

    public function store(Request $request)
    {
        //dd($request);
        //$request->input('description');
        $path = $request->file('file')->store('requestFiles');

        $attributes = ['owner_id' => 1,
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

        return redirect()->route('requestsDashboard');
    }

    public function details()
    {
        $title = 'Detalhes do produto';

        return view('requests/details', compact('title'));
    }

    public function dashboard()
    {
        $title = 'Pedidos';

        $requests = PrintRequest::all();

        return view('requests/dashboard', compact('title', 'requests'));
    }
}
