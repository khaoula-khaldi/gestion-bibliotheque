<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;
use App\Models\Emprunt;

class EmpruntController extends Controller
{
    //tout les emprunt 
    public function index(){
        $emprunts=Emprunt::with(['user','livre'])->get();
        return view('emprunts.index',compact('emprunts'));
    }

    public function create()
    {
        $livres = Livre::all();
        return view('emprunts.create', compact('livres'));
    }

    //store un emprunt 
    public function store(Request $request){
        
        $request->validate(['livre_id' => 'required|exists:livres,id']);
        $user = auth()->user();

        $livre = Livre::findOrFail($request->livre_id);
        
        $hasAbonnement = $user->subscriptions()
                            ->where('statut', 'actif')
                            ->where('date_fin', '>=', now())
                            ->exists();

        // condition  ? si vrai   : si foot 
        $prixFinal = $hasAbonnement ? ($livre->prix * 0.5) : $livre->prix;

        $dejaEmprunte = Emprunt::where('user_id', $user->id)->whereIn('statut', ['en_cours', 'retard'])->exists();
        if ($dejaEmprunte) {
            return redirect()->back()->with('error', 'Vous devez rendre votre livre actuel avant d\'en prendre un autre !');
        }

        Emprunt::create([
            'user_id'  => $user->id,
            'livre_id' => $request->livre_id,
            'prix'     => $prixFinal, 
            'statut'   => 'en_cours',
        ]);

        return back()->with('success', "Bien! Prix: $prixFinal DH");
    }

    //retour un livre
    public function retour($id){
        $emprunt = Emprunt::findOrFail($id);

        if ($emprunt->statut === 'retourné') {
            return back()->with('error', 'Ce livre est déjà marqué comme retourné.');
        }

        $emprunt->update([
            'date_retour' => now(),
            'statut' => 'retourné'
        ]);

        $emprunt->livre->increment('quantite');

        return back()->with('success', 'Livre retourné avec succès et stock mis à jour !');
    }

    //mes emprunt 
    public function mesEmprunts(){
        $emprunts = Emprunt::where('user_id', auth()->id())
                        ->with(['livre']) 
                        ->get();

        return view('emprunts.mes_emprunts', compact('emprunts'));
    }
}
