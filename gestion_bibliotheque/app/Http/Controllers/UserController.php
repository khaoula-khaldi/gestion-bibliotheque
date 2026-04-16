<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        
        $users = User::all(); 

        return view('admin.users.index', compact('users'));
    }


    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        $message = $user->is_active ? 'Utilisateur réactivé.' : 'Utilisateur banni.';
        return back()->with('success', $message);
    }
}