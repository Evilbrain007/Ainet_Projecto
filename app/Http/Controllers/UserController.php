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

    public function getUserName($id){

        //$name = User::where('id', $id)->get();
        //receber o id do user e devolver o nome
       // return
    }
}
