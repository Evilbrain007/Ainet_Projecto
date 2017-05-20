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

        $this->checkUser($user);
        
        $departments = Department::all();

        $title = "Editar Perfil"; //isto esta bem? ou evita so buscar o id na vista blade?

        return view('users/edit', compact('title', 'user', 'departments'));
    }

    public function update(Request $request, User $id)
    {
        $this->checkUser($id);
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

    public static function checkUserIsCurrentUser($userId)
    {
        return (Auth::id() == $userId);
    }

    public function checkUser($user)
    {
        if (UserController::checkUserIsCurrentUser($user->id)){
            $message = ['message_error' => 'O URL introduzido não corresponde ao URL do seu utilizador'];
            return redirect()->route('home')->with($message);
        }
        return;
    }

}
