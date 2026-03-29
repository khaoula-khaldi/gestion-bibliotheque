<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function toggleActive(User $user)
    {
        // 🔐 vérifier admin
        if (!auth()->user()->is_admin) {
            abort(403, 'Accès interdit');
        }

        // 🔁 toggle (activer / désactiver)
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->back()->with('success', 'Statut modifié avec succès !');
    }
}