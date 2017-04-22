<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listUsers()
    {
        $title = "Listagem de Utilizadores";

        return view('dashboard');
    }
}
