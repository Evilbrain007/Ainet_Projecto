<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use GuzzleHttp\Psr7\Request;

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

        $department = Department::find($user->department_id);

        return view('users.details', compact('title', 'user', 'department'));
    }

    public function edit(User $id)
    {
        $user = $id;
        $departments = Department::all();

        $title = "Editar Perfil"; //isto esta bem? ou evita so buscar o id na vista blade?

        return view('users/edit', compact('title', 'user', 'departments'));
    }

    public function update(Request $request, $id)
    {
        dd($request);
    }


    public function setUserAsAdmin(User $id)
    {
        $user = $id;
        $user->admin = true;
        User::store($user);
        return redirect(route('home'));
    }


    public function setUserAsEmployee(User $id)
    {
        $user = $id;
        $user->admin = false;
        User::store($user);

        return redirect(route('home'));
    }

    public function blockUser(User $id)
    {
        $user = $id;
        $user->blocked = true;
        User::store($user);

        return redirect(route('home'));
    }

    public function unblockUser(User $id)
    {
        $user = $id;
        $user->blocked = false;
        User::store($user);

        return redirect(route('home'));
    }

    public function getUserName($id)
    {
        //$name = User::where('id', $id)->get();
        //receber o id do user e devolver o nome
        // return
    }

    public function getUserImage(User $user_id)
    {
        $user = $user_id;
        $imagePath = $user->getAttribute('profile_photo');
        if($imagePath == null){
            return  response()->file(public_path().'/images/default_profile_photo.png');
        }
        return  response()->file(storage_path('app/public/profiles/'.$imagePath));

    }


}
