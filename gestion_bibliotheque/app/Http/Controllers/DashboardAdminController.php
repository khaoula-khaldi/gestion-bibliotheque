<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;

class DashboardAdminController extends Controller
{
    public function index(){
        $usersCount = User::count();

        $subscriptionsCount = Subscription::count();

        $activeSubscriptions = Subscription::where('statut', 'actif')->count();

        $expiredSubscriptions = Subscription::where('date_fin', '<', now())->count();

        return view('admin.dashboard', compact(
            'usersCount',
            'subscriptionsCount',
            'activeSubscriptions',
            'expiredSubscriptions'
        ));
    }
}