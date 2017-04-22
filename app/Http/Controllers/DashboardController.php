<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getIndex()
    {
        $title = "Printit!";

        return view('dashboard', compact('title'));
    }
}
