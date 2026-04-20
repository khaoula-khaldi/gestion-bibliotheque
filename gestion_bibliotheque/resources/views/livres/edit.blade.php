@extends('layouts.app')

@section('title', 'Modifier | ' . $livre->titre)

@section('content')
<div class="max-w-2xl mx-auto">
    
    <div class="mb-10">
        <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Modifier l'Ouvrage</h1>
        <p class="text-[10px] text-slate-400 font-bold tracking-[2px] uppercase mt-1">Mise à jour de : {{ $livre->titre }}</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs font-bold uppercase tracking-wider">
            @foreach ($errors->all() as $error)
                <p>• {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('livres.update', $livre->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-8 border border-slate-200 rounded-sm shadow-sm">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Titre du livre</label>
                <input type="text" name="titre" value="{{ old('titre', $livre->titre) }}" 
                       class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-bold outline-none focus:border-blue-500 transition">
            </div>

            <div class="md:col-span-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Auteur</label>
                <select name="auteur_id" class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-bold outline-none focus:border-blue-500 transition cursor-pointer">
                    @foreach($auteurs as $auteur)
                        <option value="{{ $auteur->id }}" {{ $livre->auteur_id == $auteur->id ? 'selected' : '' }}>
                            {{ $auteur->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Prix Emprunt (DH)</label>
                <input type="number" step="0.01" name="prix_emprunt" value="{{ old('prix_emprunt', $livre->prix_emprunt) }}" 
                       class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-bold outline-none focus:border-blue-500 transition">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Quantité en Stock</label>
                <input type="number" name="quantite" value="{{ old('quantite', $livre->quantite) }}" 
                       class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-bold outline-none focus:border-blue-500 transition">
            </div>
        </div>

        <div class="p-4 bg-slate-50 border border-dashed border-slate-200 rounded-sm">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Image de couverture</label>
            <div class="flex items-center gap-6">
                @if($livre->image)
                    <div class="relative">
                        <img src="{{ asset('storage/' . $livre->image) }}" class="h-20 w-16 object-cover border-2 border-white shadow-sm rounded-sm">
                        <span class="absolute -top-2 -right-2 bg-blue-600 text-white text-[8px] px-1 rounded font-bold">ACTUEL</span>
                    </div>
                @endif
                <input type="file" name="image" class="text-[10px] font-bold text-slate-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-slate-900 file:text-white hover:file:bg-blue-600 file:cursor-pointer">
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Description</label>
            <textarea name="description" rows="4" 
                      class="w-full bg-slate-50 border border-slate-100 p-3 text-sm font-medium outline-none focus:border-blue-500 transition resize-none">{{ old('description', $livre->description) }}</textarea>
        </div>

        <div class="pt-6 flex items-center justify-end gap-6 border-t border-slate-50">
            <a href="{{ route('livres.index') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition">
                Annuler
            </a>
            <button type="submit" class="bg-slate-900 text-white px-10 py-3 text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 shadow-md transition">
                Mettre à jour l'ouvrage
            </button>
        </div>
    </form>
</div>
@endsection