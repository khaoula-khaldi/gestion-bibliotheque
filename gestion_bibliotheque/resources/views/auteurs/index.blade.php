@extends('layouts.app')

@section('title', 'Auteurs | BiblioTech')

@section('content')
<div class="max-w-5xl mx-auto">
    
    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 text-xs font-bold uppercase tracking-wider">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 pb-6 border-b border-slate-200 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 uppercase italic">Gestion des Auteurs</h1>
            <p class="text-[10px] text-slate-400 font-bold tracking-widest mt-1 uppercase">Répertoire des écrivains et contributeurs</p>
        </div>
        <a href="{{ route('auteurs.create') }}" 
           class="bg-slate-900 text-white px-6 py-2 text-[10px] font-black uppercase tracking-widest rounded hover:bg-slate-800 transition shadow-sm">
            + Ajouter un auteur
        </a>
    </div>

    <div class="bg-white border border-slate-200 rounded shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Nom de l'Auteur</th>
                        <th class="px-6 py-4">Date de Naissance</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($auteurs as $auteur)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-slate-700 uppercase tracking-tight">
                                {{ $auteur->nom }} {{ $auteur->prenom }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs text-slate-500 font-medium">
                                {{ $auteur->date_naissance ? \Carbon\Carbon::parse($auteur->date_naissance)->format('d/m/Y') : '—' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-4 text-[10px] font-bold uppercase tracking-tighter">
                                <a href="{{ route('auteurs.edit', $auteur->id) }}" class="text-blue-600 hover:underline">Modifier</a>
                                
                                <form action="{{ route('auteurs.destroy', $auteur->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cet auteur ?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline uppercase">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-20 text-center">
                            <p class="text-slate-300 font-bold tracking-widest text-[10px] uppercase italic">
                                Aucun auteur répertorié
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-12 text-center">
        <p class="text-[9px] text-slate-300 font-bold tracking-[5px] uppercase">
            BiblioTech • Database System
        </p>
    </div>
</div>
@endsection