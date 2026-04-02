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

        $request->validate([
            'livre_id'=>'required|exists:livres,id',
        ]);

        $user=auth()->user();

        Emprunt::create([
            'user_id'=>$user->id,
            'livre_id'=>$request->livre_id,
            'statut'=>'en_cours',
        ]);
        return back()->with('success','bien!');

    }

    //retour un livre
    public function retour($id){
        $emprunt=Emprunt::findOrFail($id);

        $emprunt->update([
            'date_retour' => now(),
            'statut' => 'retourné'
        ]);

        return back()->with('success','bien retour!');
    }
}
