@extends('layouts.app')

@section('title', 'Catalogue')

@section('content')
<div class="max-w-6xl mx-auto">
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 border-b border-slate-200 pb-6 gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Catalogue</h1>
            <p class="text-[10px] text-slate-400 font-bold tracking-[2px] mt-1 uppercase">
                Total: {{ count($livres) }} Livres en stock
            </p>
        </div>
        
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('livres.create') }}" class="w-full sm:w-auto text-center bg-slate-900 text-white px-6 py-2.5 text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 transition-all rounded shadow-sm">
                + Ajouter un Livre
            </a>
        @endif
    </div>

    <div class="bg-white border border-slate-200 rounded-sm shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-[10px] font-black text-slate-500 uppercase tracking-widest">
                        <th class="px-6 py-4">Livre & ISBN</th>
                        <th class="px-6 py-4 text-center">Auteur</th>
                        <th class="px-6 py-4 text-center">Prix</th>
                        <th class="px-6 py-4 text-center">Disponibilité</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($livres as $livre)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-5">
                            <div class="text-sm font-bold text-slate-800">{{ $livre->titre }}</div>
                            <div class="text-[9px] text-slate-400 font-medium mt-0.5 tracking-wider">ISBN: {{ $livre->isbn }}</div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="text-xs font-semibold text-slate-600 bg-slate-100 px-2 py-1 rounded">
                                {{ $livre->auteur->nom ?? 'Inconnu' }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="text-sm font-black text-slate-900">{{ number_format($livre->prix_emprunt, 2) }} DH</span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="text-[9px] font-black px-3 py-1 rounded-full border {{ $livre->quantite > 0 ? 'text-emerald-600 border-emerald-100 bg-emerald-50' : 'text-red-500 border-red-100 bg-red-50' }} uppercase tracking-tighter">
                                {{ $livre->quantite > 0 ? $livre->quantite . ' en stock' : 'Rupture' }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <div class="flex justify-end gap-4 text-[10px] font-black uppercase tracking-widest">
                                <a href="{{ route('livres.show', $livre->id) }}" class="text-blue-500 hover:text-blue-700">Détails</a>
                                
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('livres.edit', $livre->id) }}" class="text-slate-900 hover:text-blue-600">Modifier</a>
                                    
                                    <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Supprimer ce livre ?')" class="text-red-500 hover:text-red-700">
                                            Supprimer
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-[3px]">Catalogue actuellement vide</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <p class="mt-10 text-center text-[9px] text-slate-300 tracking-[5px] uppercase font-bold">
        BiblioTech System • Professional Edition
    </p>
</div>
@endsection