<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function listUsers()
    {
        $title = "Listagem de Utilizadores";

        return view('dashboard');
    }


    public function details(User $id)
    {
        $user = $id;

        $title = "Detalhes do Utilizador";

        return view('users.details', compact('title', 'user'));
    }

    public function setUserAsAdmin(User $id)
    {
        $user = $id;
        $user->admin = true;
        $user->save();
        return redirect(route('home'));
    }


    public function setUserAsEmployee(User $id)
    {
        $user = $id;
        $user->admin = false;
        User::store($user);

        return redirect(route('home'));
    }

    public function getUserName($id)
    {

        //$name = User::where('id', $id)->get();
        //receber o id do user e devolver o nome
        // return
    }
}
