@extends('layouts.app')

@section('title', 'Nouvel Ouvrage | BiblioTech')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <div class="mb-10">
        <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Nouvel Ouvrage</h1>
        <p class="text-[10px] text-slate-400 font-bold tracking-[2px] uppercase mt-1">Ajouter un nouveau livre au catalogue de la bibliothèque</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs font-bold uppercase tracking-wider">
            @foreach ($errors->all() as $error)
                <p class="flex items-center gap-2">
                    <span class="w-1 h-1 bg-red-500 rounded-full"></span>
                    {{ $error }}
                </p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('livres.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-8 border border-slate-200 rounded-sm shadow-sm">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Titre du livre</label>
                <input type="text" name="titre" value="{{ old('titre') }}" placeholder="Ex: L'Alchimiste"
                       class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-bold outline-none focus:border-blue-500 transition">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Code ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn') }}" placeholder="978-..."
                       class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-bold outline-none focus:border-blue-500 transition">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Auteur</label>
                <select name="auteur_id" class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-bold outline-none focus:border-blue-500 transition cursor-pointer">
                    <option value="" class="text-slate-400 italic">Choisir un auteur</option>
                    @foreach($auteurs as $auteur)
                        <option value="{{ $auteur->id }}" {{ old('auteur_id') == $auteur->id ? 'selected' : '' }}>
                            {{ $auteur->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Prix Achat (DH)</label>
                <input type="number" step="0.01" name="prix_achat" value="{{ old('prix_achat') }}" 
                       class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-bold outline-none focus:border-blue-500 transition">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Prix Emprunt (DH)</label>
                <input type="number" step="0.01" name="prix_emprunt" value="{{ old('prix_emprunt') }}" 
                       class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-bold outline-none focus:border-blue-500 transition">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Quantité en Stock</label>
                <input type="number" name="quantite" value="{{ old('quantite') }}" 
                       class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-bold outline-none focus:border-blue-500 transition">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Année d'édition</label>
                <input type="number" name="annee" value="{{ old('annee') }}" 
                       class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-bold outline-none focus:border-blue-500 transition">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Type d'accès</label>
                <select name="type" class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-bold outline-none focus:border-blue-500 transition cursor-pointer">
                    <option value="free" {{ old('type') == 'free' ? 'selected' : '' }}>Standard (Free)</option>
                    <option value="premium" {{ old('type') == 'premium' ? 'selected' : '' }}>Premium</option>
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">État initial</label>
                <select name="disponible" class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-bold outline-none focus:border-blue-500 transition cursor-pointer">
                    <option value="1" {{ old('disponible') == '1' ? 'selected' : '' }}>Disponible immédiatement</option>
                    <option value="0" {{ old('disponible') == '0' ? 'selected' : '' }}>Indisponible</option>
                </select>
            </div>
        </div>

        <div class="p-5 bg-slate-50 border border-dashed border-slate-200 rounded-sm">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Image de couverture</label>
            <input type="file" name="image" 
                   class="text-[10px] font-bold text-slate-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-slate-900 file:text-white hover:file:bg-blue-600 file:cursor-pointer transition">
        </div>

        <div>
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Résumé / Description</label>
            <textarea name="description" rows="4" placeholder="Brève description de l'ouvrage..."
                      class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-medium outline-none focus:border-blue-500 transition resize-none">{{ old('description') }}</textarea>
        </div>

        <div class="pt-8 flex items-center justify-end gap-6 border-t border-slate-50">
            <a href="{{ route('livres.index') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition">
                Annuler
            </a>
            <button type="submit" class="bg-slate-900 text-white px-10 py-3 text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 shadow-md transition-all active:scale-95">
                Créer l'ouvrage
            </button>
        </div>
    </form>
</div>
@endsection