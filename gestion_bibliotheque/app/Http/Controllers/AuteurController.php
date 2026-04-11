<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurController extends Controller
{
    // get tout lesauteur
    public function index()
    {
        $auteurs = Auteur::all();
        return view('auteurs.index', compact('auteurs'));
    }

    // Formulaire de creation
    public function create()
    {
        return view('auteurs.create');
    }

    // ajouter  un auteur dans db
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'nullable|date',
            'biographie' => 'nullable|string',
        ]);

        Auteur::create($request->all());

        return redirect()->route('auteurs.index')->with('success', 'Auteur ajouté avec succès !');
    }

    //voir un auteur
    public function show($id)
    {
        $auteur=Auteur::FindOrFail($id);
        return view('auteurs.show', compact('auteur'));
    }

    //from de update
    public function edit($id)
    {
        $auteur=Auteur::FindOrFail($id);
        return view('auteurs.edit', compact('auteur'));
    }

    // modiffier auteur
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'nullable|date',
            'biographie' => 'nullable|string',
        ]);

        $auteur = Auteur::findOrFail($id);
        $auteur->update($request->all());

        return redirect()->route('auteurs.index')->with('success', 'Auteur mis à jour !');
    }

    // Supprimer auteur
    public function destroy($id){
        $auteur = Auteur::findOrFail($id);

        if ($auteur->livres()->count() > 0) {
            return redirect()->route('auteurs.index')
                ->with('error', "Impossible de supprimer cet auteur car il possède encore des livres dans le catalogue.");
        }

        $auteur->delete();

        return redirect()->route('auteurs.index')
            ->with('success', 'Auteur supprimé avec succès !');
    }
}