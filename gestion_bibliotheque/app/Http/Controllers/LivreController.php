<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;
use App\Models\Auteur;
use Illuminate\Support\Facades\Storage;

class LivreController extends Controller
{
    // Afficher tous les livres
    public function index(){

        $livres = Livre::all();
        return view('livres.index', compact('livres'));
    }

    public function catalogue(Request $request) {
        $user = auth()->user();
        
        $hasActiveSub = $user->subscriptions()
            ->where('statut', 'actif')
            ->where('date_fin', '>=', now())
            ->exists();

        $livresEmpruntesIds = \App\Models\Emprunt::where('user_id', $user->id)
            ->whereIn('statut', ['en cours', 'en_cours', 'retard'])
            ->pluck('livre_id')
            ->toArray();

        $query = Livre::with('auteur')->where('quantite', '>', 0);

        if ($request->has('keyword') && !empty($request->keyword)) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('titre', 'like', "%{$keyword}%")
                ->orWhere('isbn', 'like', "%{$keyword}%")
                ->orWhereHas('auteur', function($queryAuteur) use ($keyword) {
                    $queryAuteur->where('nom', 'like', "%{$keyword}%")
                                ->orWhere('prenom', 'like', "%{$keyword}%");
                });
            });
        }

        $livres = $query->get()->map(function ($livre) use ($hasActiveSub) {
            $prixBase = $livre->prix_emprunt ?? 0;
            $livre->prix_final = $hasActiveSub ? ($prixBase * 0.5) : $prixBase;
            return $livre;
        });

        return view('livres.catalogue', compact('livres', 'hasActiveSub', 'livresEmpruntesIds'));
    }


    public function create(){
        if(auth()->user()->role !== 'admin'){
            abort(403);
        }
        $auteurs = Auteur::all();
        return view('livres.create', compact('auteurs'));
    }

    // Ajouter livre dans la DB
    public function store(Request $request){
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'isbn' => 'required|string|unique:livres,isbn',
            'annee' => 'required|digits:4|integer',
            'type' => 'required|in:free,premium',
            'description' => 'nullable|string',
            'prix_achat' => 'required|numeric',
            'prix_emprunt' => 'required|numeric',
            'disponible' => 'required|boolean',
            'quantite' => 'required|integer',
            'auteur_id' => 'required|exists:auteurs,id', 
            'image' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // uploader 'public/images' store chemin
            $path = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $path;
        }

        Livre::create($validatedData);

        return redirect()->route('livres.index')->with('success', 'Livre ajouté avec succès!');
    }

    public function edit($id){
        if(auth()->user()->role !== 'admin'){
            abort(403);
        }
        $livre = Livre::findOrFail($id);
        $auteurs = Auteur::all();
        return view('livres.edit', compact('livre', 'auteurs'));
    }

    // Update un livre dans la DB
    public function update(Request $request, $id){
        $livre = Livre::findOrFail($id);

        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur_id' => 'required|exists:auteurs,id',
            'prix_emprunt' => 'required|numeric',
            'quantite' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'isbn' => 'nullable|string|unique:livres,isbn,'.$id,
            'type' => 'nullable|in:free,premium',
            'prix_achat' => 'nullable|numeric',
            'disponible' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($livre->image) {
                Storage::disk('public')->delete($livre->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $livre->image = $path;
        }
        $livre->update($request->except('image'));

        return redirect()->route('livres.index')->with('success', 'Livre modifié avec succès!');
    }

    public function destroy($id){
        if(auth()->user()->role !== 'admin'){
            abort(403);
        }
        $livre = Livre::findOrFail($id);
        
        // supprime img storage
        if ($livre->image) {
            Storage::disk('public')->delete($livre->image);
        }
        
        $livre->delete();
        return redirect()->route('livres.index')->with('success', 'Livre supprimé!');
    }

    public function show($id){
        $livre = Livre::findOrFail($id);
        return view('livres.show', compact('livre'));
    }
}