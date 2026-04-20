@extends('layouts.app')

@section('title', 'Ventes | BiblioTech')

@section('content')
<div class="max-w-5xl mx-auto p-4">
    
    <div class="mb-8 pb-4 border-b">
        <h1 class="text-xl font-bold text-slate-800 uppercase italic">Registre des Ventes</h1>
        <p class="text-[10px] text-slate-400 font-bold tracking-widest uppercase">Historique des transactions</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="p-4 bg-slate-50 border border-slate-200 rounded">
            <p class="text-[10px] font-bold text-slate-400 uppercase">Chiffre d'Affaires</p>
            <p class="text-xl font-bold text-slate-900">{{ number_format($achats->sum('prix'), 2) }} DH</p>
        </div>
        <div class="p-4 bg-slate-50 border border-slate-200 rounded">
            <p class="text-[10px] font-bold text-slate-400 uppercase">Total Ventes</p>
            <p class="text-xl font-bold text-slate-900">{{ $achats->count() }}</p>
        </div>
        <div class="p-4 bg-slate-50 border border-slate-200 rounded">
            <p class="text-[10px] font-bold text-slate-400 uppercase">Clients</p>
            <p class="text-xl font-bold text-slate-900">{{ $achats->unique('user_id')->count() }}</p>
        </div>
    </div>

    <div class="bg-white border border-slate-200 shadow-sm overflow-hidden rounded">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                    <th class="px-6 py-4">Client</th>
                    <th class="px-6 py-4">Ouvrage</th>
                    <th class="px-6 py-4 text-center">Montant</th>
                    <th class="px-6 py-4 text-right">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($achats as $achat)
                <tr class="hover:bg-slate-50/50">
                    <td class="px-6 py-4 text-sm font-semibold text-slate-700">
                        {{ $achat->user->name }}
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500 italic">
                        {{ $achat->livre->titre }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="font-bold text-slate-900">{{ number_format($achat->prix, 2) }} DH</span>
                    </td>
                    <td class="px-6 py-4 text-right text-xs text-slate-400 font-bold">
                        {{ $achat->created_at->format('d/m/Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-20 text-center text-slate-300 italic uppercase text-[10px] tracking-widest">
                        Aucune transaction indexée
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-12 text-center">
        <p class="text-[9px] text-slate-300 font-bold tracking-[5px] uppercase">
            BiblioTech • Record System
        </p>
    </div>
</div>
@endsection