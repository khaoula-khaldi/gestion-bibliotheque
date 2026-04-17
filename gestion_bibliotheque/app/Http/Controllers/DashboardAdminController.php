<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_livres'   => Livre::count(),
            'total_users'    => User::where('role', 'user')->count(),
            'total_actifs'   => Subscription::where('statut', 'actif')->count(),
        ];

        $recentSubscriptions = Subscription::with('user')->latest()->take(5)->get();
        $lowStockLivres = Livre::where('quantite', '<', 5)->get();

        return view('admin.dashboard', compact('stats', 'recentSubscriptions', 'lowStockLivres'));
    }
}