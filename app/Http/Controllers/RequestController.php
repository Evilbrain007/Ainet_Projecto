<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
