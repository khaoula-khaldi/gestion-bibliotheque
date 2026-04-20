@extends('layouts.app')

@section('title', (isset($auteur) ? 'Modifier' : 'Ajouter') . ' Auteur | BiblioTech')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <a href="{{ route('auteurs.index') }}" class="inline-flex items-center text-[10px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest transition mb-8">
        <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Retour à la liste
    </a>

    <div class="bg-white border border-slate-200 rounded-sm shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-xl font-bold text-slate-800 uppercase italic">
                {{ isset($auteur) ? 'Modifier' : 'Ajouter' }} un Auteur
            </h2>
            <p class="text-[10px] text-slate-400 font-bold tracking-widest uppercase">Fiche biographique</p>
        </div>

        <form action="{{ isset($auteur) ? route('auteurs.update', $auteur->id) : route('auteurs.store') }}" method="POST" class="p-8">
            @csrf
            @if(isset($auteur)) @method('PUT') @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Nom</label>
                    <input type="text" name="nom" value="{{ $auteur->nom ?? old('nom') }}" 
                        class="w-full border border-slate-200 rounded-sm px-4 py-3 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Prénom</label>
                    <input type="text" name="prenom" value="{{ $auteur->prenom ?? old('prenom') }}" 
                        class="w-full border border-slate-200 rounded-sm px-4 py-3 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition" required>
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Date de Naissance</label>
                <input type="date" name="date_naissance" value="{{ $auteur->date_naissance ?? old('date_naissance') }}" 
                    class="w-full border border-slate-200 rounded-sm px-4 py-3 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
            </div>

            <div class="mb-10">
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Biographie</label>
                <textarea name="biographie" rows="5" 
                    class="w-full border border-slate-200 rounded-sm px-4 py-3 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition placeholder-slate-300" 
                    placeholder="Détails sur le parcours de l'auteur...">{{ $auteur->biographie ?? old('biographie') }}</textarea>
            </div>

            <button type="submit" class="w-full bg-slate-900 text-white py-4 text-[10px] font-black uppercase tracking-[3px] hover:bg-slate-800 transition-all shadow-md">
                {{ isset($auteur) ? 'Mettre à jour' : 'Enregistrer' }} l'auteur
            </button>
        </form>
    </div>
</div>
@endsection