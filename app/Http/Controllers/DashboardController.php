<?php

namespace App\Http\Controllers;

use App\Departament;
use App\User;
use Illuminate\Database\Eloquent\Model;

class DashboardController extends Controller
{
    public function getIndex()
    {
        $title = "Printit!";

        $users = User::all();
        $departments = Departament::all();

        return view('dashboard', compact('title', 'users', 'departments'));


    }
}
