<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;
use App\Models\Achat;
use App\Models\Emprunt;
use App\Models\Subscription; 

class DashboardController extends Controller{
    public function index(){
        $user = auth()->user();

        $hasActiveSub = Subscription::where('user_id', $user->id)
                                                ->where('statut', 'actif')
                                                ->where('date_fin', '>', now())
                                                ->exists();

        if ($hasActiveSub) {
            $livres = Livre::latest()->take(6)->get();
        } else {
            $livres = Livre::where('type', 'free')->latest()->take(6)->get();
        }

        // $achats = $user->achats()->with('livre')->get();
        // $emprunts = $user->emprunts()->with('livre')->get();

        return view('dashboard', compact('livres','hasActiveSub'));
    }
}