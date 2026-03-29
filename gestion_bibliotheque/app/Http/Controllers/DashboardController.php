<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // ghedi njib kol users
        $users = User::all(); 

        // n3tihom l view
        return view('dashboard', compact('users'));
    }
}
