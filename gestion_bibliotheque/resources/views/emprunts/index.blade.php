@extends('layouts.app')

@section('title', 'Gestion Emprunts | BiblioTech Admin')

@section('content')
<div class="max-w-6xl mx-auto">
    
    <div class="mb-10 border-b border-slate-200 pb-6">
        <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Flux des Emprunts</h1>
        <p class="text-[10px] text-slate-400 font-bold tracking-[3px] mt-1 uppercase">
            Supervision des retours et gestion du stock
        </p>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-white border-2 border-slate-900 text-[10px] font-black uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(15,23,42,1)]">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-slate-200 rounded-sm shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[800px]">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-[10px] font-black text-slate-500 uppercase tracking-[2px]">
                        <th class="px-6 py-4">Lecteur</th>
                        <th class="px-6 py-4">Ouvrage Emprunté</th>
                        <th class="px-6 py-4 text-center">Statut</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($emprunts as $emprunt)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-5">
                            <div class="text-sm font-bold text-slate-900">{{ $emprunt->user->name }}</div>
                            <div class="text-[10px] text-slate-400 font-medium italic tracking-wide">{{ $emprunt->user->email }}</div>
                        </td>

                        <td class="px-6 py-5">
                            <div class="text-xs font-bold border-l-4 border-slate-900 pl-3 py-1 bg-slate-50 inline-block">
                                {{ $emprunt->livre->titre }}
                            </div>
                        </td>

                        <td class="px-6 py-5 text-center">
                            @if(in_array(strtolower($emprunt->statut), ['en_cours', 'en cours']))
                                <span class="px-3 py-1 text-[9px] font-black uppercase bg-amber-50 text-amber-600 border border-amber-100 rounded-full">
                                    En cours
                                </span>
                            @else
                                <span class="px-3 py-1 text-[9px] font-black uppercase bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-full">
                                    Rendu
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-5 text-right">
                            @if(in_array(strtolower($emprunt->statut), ['en_cours', 'en cours']))
                                <form action="{{ route('emprunts.retour', $emprunt->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Confirmer le retour de cet ouvrage ?')" 
                                            class="border-2 border-slate-900 px-4 py-2 text-[10px] font-black uppercase tracking-tighter hover:bg-slate-900 hover:text-white transition-all duration-300">
                                        Valider le Retour
                                    </button>
                                </form>
                            @else
                                <div class="text-right">
                                    <p class="text-slate-400 text-[9px] font-black uppercase tracking-widest">Restitué le</p>
                                    <p class="text-slate-900 text-xs font-bold">
                                        {{ $emprunt->date_retour ? \Carbon\Carbon::parse($emprunt->date_retour)->format('d/m/Y') : '–' }}
                                    </p>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-24 text-center">
                            <p class="text-slate-300 font-black tracking-[5px] text-[10px] uppercase italic">
                                Aucun flux d'emprunt actif dans la base
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-16 text-center border-t border-slate-100 pt-8">
        <p class="text-[9px] text-slate-300 font-black tracking-[5px] uppercase">
            Zone Administrateur • BiblioTech Protocol • V2.0
        </p>
    </div>
</div>
@endsection