@extends('layouts.app')

@section('title', 'Détails | ' . $livre->titre)

@section('content')
<div class="max-w-5xl mx-auto">
    
    <a href="{{ route('livres.index') }}" class="inline-flex items-center text-[10px] font-black uppercase tracking-[2px] text-slate-400 hover:text-blue-600 mb-8 transition">
        ← Retour au catalogue
    </a>

    <div class="bg-white border border-slate-200 rounded-sm overflow-hidden flex flex-col md:flex-row shadow-sm">
        
        <div class="md:w-1/3 bg-slate-50 flex items-center justify-center border-b md:border-b-0 md:border-r border-slate-200 p-6">
            @if($livre->image)
                <img src="{{ asset('storage/' . $livre->image) }}" class="w-full h-auto rounded-sm shadow-md">
            @else
                <div class="py-20 text-[10px] font-black text-slate-300 text-center uppercase tracking-widest">
                    Aucun visuel <br> disponible
                </div>
            @endif
        </div>

        <div class="md:w-2/3 p-10">
            <div class="mb-6">
                <span class="text-[9px] font-black bg-blue-600 text-white px-3 py-1 uppercase tracking-widest">
                    {{ $livre->type }}
                </span>
            </div>

            <h1 class="text-4xl font-black text-slate-900 mb-2 leading-tight uppercase">{{ $livre->titre }}</h1>
            <p class="text-lg text-slate-400 font-bold mb-10">Par : <span class="text-blue-600 uppercase">{{ $livre->auteur->nom }}</span></p>

            <div class="grid grid-cols-2 gap-y-8 gap-x-4 mb-10 border-y border-slate-50 py-8">
                <div>
                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1">Prix d'achat</p>
                    <p class="text-2xl font-black text-slate-900">{{ number_format($livre->prix_achat, 2) }} <span class="text-xs">DH</span></p>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1">Prix d'emprunt</p>
                    <p class="text-2xl font-black text-slate-900">{{ number_format($livre->prix_emprunt, 2) }} <span class="text-xs">DH</span></p>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1">Disponibilité</p>
                    <p class="text-xl font-bold {{ $livre->quantite > 0 ? 'text-emerald-600' : 'text-red-500' }}">
                        {{ $livre->quantite > 0 ? $livre->quantite . ' Unités' : 'Rupture de stock' }}
                    </p>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1">Identifiant</p>
                    <p class="text-sm font-bold text-slate-700">ISBN: {{ $livre->isbn }}</p>
                </div>
            </div>

            <div class="mb-10">
                <h3 class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4">Description de l'ouvrage</h3>
                <p class="text-slate-600 leading-relaxed text-sm">
                    {{ $livre->description ?? 'Aucune description disponible pour cet ouvrage.' }}
                </p>
            </div>

            @if(auth()->user()->role === 'admin')
                <div class="flex gap-4 pt-6 border-t border-slate-100">
                    <a href="{{ route('livres.edit', $livre->id) }}" class="bg-slate-900 text-white px-8 py-3 text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 transition">
                        Modifier les informations
                    </a>
                    <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" onsubmit="return confirm('Sûr ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="border border-red-200 text-red-500 px-8 py-3 text-[10px] font-black uppercase tracking-widest hover:bg-red-50 transition">
                            Supprimer
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection