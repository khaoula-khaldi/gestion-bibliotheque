<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;

class LivreController extends Controller
{
    //tout les livres
    public function index(){
        $livres=Livre::all();
        return view('livres.index',compact('livres'));
    }

    //redirection a view pour ajouter un livre 
    public function create(){
        return view('Livres.create');
    }

    //ajouter livre dans db
    public function store(Request $request){

        $request->validate([
            'titre' => 'required|string|max:255',
            'isbn' => 'required|string|unique:livres,isbn',
            'annee' => 'required|digits:4|integer',
            'type' => 'required|in:free,premium',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'disponible' => 'required|boolean',
            'quantite' => 'required|integer',
            'auteur_id' => 'required|exists:users,id',
        ]);
       
        Livre::create($request->all());

        return redirect()->route('livres.index')->with('success', 'Livre ajouter avec succès!');
    }

    //supprimer un livre
    public function destroy($id){
        $livre=Livre::findOrFail($id);
        $livre->delete();

        return redirect()->route('livres.index')->with('success','livre supprimer!!');
    }

    //view update
    public function edit($id){
        $livres=Livre::findOrFail($id);
        return view('livres.edit',compact('livres'));
    }

    //update dans db
    public function update(Request $request ,$id){
        $request->validate([
            'titre' => 'required|string|max:255',
            'isbn' => 'required|string|unique:livres,isbn',
            'annee' => 'required|digits:4|integer',
            'type' => 'required|in:free,premium',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'disponible' => 'required|boolean',
            'quantite' => 'required|integer',
            'auteur_id' => 'required|exists:users,id',
        ]);

        $livres=Livre::findOrFail($id);
        $livres->update($request->all());

        return redirect()->route('livres.index')->with('success','livre modifier!!');
        
    }

    //get un livre specifique
    public function show($id){
        $livre=Livre::findOrFail($id);
        return view('livres.show',compact('livre'));
    }
}
