<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;

class DashboardController extends Controller
{
    public function getIndex()
    {
        $title = "Printit!";

        $users = User::all();
        $departments = Department::all();

        return view('dashboard', compact('title', 'users', 'departments'));


    }
}
