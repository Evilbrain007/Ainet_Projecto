<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrintRequest;

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

        $requests = PrintRequest::all();

        return view('requests/dashboard', compact('title', 'requests'));
    }
}
