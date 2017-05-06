<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listUsers()
    {
        $title = "Listagem de Utilizadores";

        return view('dashboard');
    }


    public function details(User $id){
        $user = $id;

        $title = "Detalhes do Utilizador";

        $department = Department::find($user->department_id);

        return view('users.details', compact('title', 'user', 'department'));
    }

    public function getUserName($id){

        //$name = User::where('id', $id)->get();
        //receber o id do user e devolver o nome
       // return
    }
}
