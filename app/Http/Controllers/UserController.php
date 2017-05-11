<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

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



    public function edit(User $id)
    {
        $user = $id;
        $departments = Department::all();

        $title = "Editar Perfil"; //isto esta bem? ou evia so buscar o id na vista blade?


        return view('users/edit', compact('title', 'user', 'departments'));
    }

    public function update (Request $request, $id){
        dd($request);
    }


    public function getUserName($id){

        //$name = User::where('id', $id)->get();
        //receber o id do user e devolver o nome
       // return
    }

    public function getUserImage(User $user_id)
    {
        if($user_id==null){
            return 'User Inválido';
        }
        $user = $user_id;
        $imageManager = new ImageManager();
        $imagePath = $user->getAttribute('profile_photo');
        if($imagePath == null){
            $img = $imageManager->make(public_path().'/images/default_profile_photo.png');
        }else{
            $img = $imageManager->make(Storage::get($imagePath));
        }
        return $img->response();

    }


}
