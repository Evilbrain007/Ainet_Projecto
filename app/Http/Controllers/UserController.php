<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

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

        // se o utilizador não for o utilizador autenticado, volta para o home
        $message = ['message_error' => 'Endereço inválido.'];
        if (Auth::id() !== $user->id) {
            return redirect(route('home'))->with($message);
        }

        $departments = Department::all();

        $title = "Editar Perfil"; //isto esta bem? ou evita so buscar o id na vista blade?

        return view('users/edit', compact('title', 'user', 'departments'));
    }

    public function update(Request $request, User $id)
    {
        $user = $id;
        // se o utilizador não for o utilizador autenticado, volta para o home
        $message = ['message_error' => 'Endereço inválido.'];
        dd(Auth::id());
        if (Auth::id() != $user->id) {
            return redirect(route('home'))->with($message);
        }

        return redirect(route('home'));
    }


    public function setUserAsAdmin(User $id)
    {
        $user = $id;
        $user->admin = true;
        User::store($user);
        return redirect()->back();
    }


    public function setUserAsEmployee(User $id)
    {
        $user = $id;
        $user->admin = false;
        User::store($user);

        return redirect()->back();
    }

    public function blockUser(User $id)
    {
        $user = $id;
        $user->blocked = true;
        User::store($user);

        return redirect()->back();
    }

    public function unblockUser(User $id)
    {
        $user = $id;
        $user->blocked = false;
        User::store($user);

        return redirect()->back();
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
        if ($imagePath == null) {
            return response()->file(public_path() . '/images/default_profile_photo.png');
        }
        return response()->file(storage_path('app/public/profiles/' . $imagePath));

    }

}
