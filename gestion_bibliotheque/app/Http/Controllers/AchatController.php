<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Livre;
use Illuminate\Http\Request;

class AchatController extends Controller
{
    //  affiche tout les achats 
    public function index(){
        $achats = Achat::with(['user', 'livre'])->get();
        return view('achats.index', compact('achats'));
    }

    public function mesAchats() {
        $achats = Achat::where('user_id', auth()->id())
                    ->with('livre')
                    ->latest()
                    ->get();
                    
        return view('achats.mes_achats', compact('achats'));
    }



    // ajouter un achat
    public function store(Request $request)
    {
        $request->validate([
            'livre_id' => 'required|exists:livres,id',
        ]);

        $livre = Livre::findOrFail($request->livre_id);

        Achat::create([
            'user_id' => auth()->id(),
            'livre_id' => $livre->id,
            'prix' => $livre->prix_achat,
            'date_achat' => now(),
        ]);

        $livre->decrement('quantite');

        return redirect()->route('achats.mes_achats');
    }
}