@extends('layouts.app')

@section('title', 'Abonnements | BiblioTech')

@section('content')
<div class="max-w-6xl mx-auto">
    
    <div class="mb-10 border-b border-slate-200 pb-6">
        <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Abonnements</h1>
        <p class="text-[10px] text-slate-400 font-bold tracking-[3px] mt-1 uppercase">Contrôle des membres et validité des accès</p>
    </div>

    <div class="bg-white border border-slate-200 rounded-sm shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[750px]">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-[10px] font-black text-slate-500 uppercase tracking-[2px]">
                        <th class="px-6 py-4">Membre</th>
                        <th class="px-6 py-4 text-center">Formule</th>
                        <th class="px-6 py-4">Période de validité</th>
                        <th class="px-6 py-4 text-right">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($subscriptions as $sub)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-5">
                            <div class="text-sm font-bold text-slate-900">{{ $sub->user->name }}</div>
                            <div class="text-[10px] text-slate-400 font-medium tracking-wide">{{ $sub->user->email }}</div>
                        </td>

                        <td class="px-6 py-5 text-center">
                            <span class="inline-block px-4 py-1 text-[9px] font-black uppercase border-2 transition-colors {{ $sub->type === 'annuel' ? 'bg-slate-900 text-white border-slate-900' : 'bg-white text-slate-900 border-slate-900' }}">
                                {{ $sub->type }}
                            </span>
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3 text-[11px] font-bold text-slate-700">
                                <span class="bg-slate-100 px-2 py-1 rounded">{{ \Carbon\Carbon::parse($sub->date_debut)->format('d/m/Y') }}</span>
                                <span class="text-slate-300">→</span>
                                <span class="{{ $sub->statut !== 'actif' ? 'text-red-500' : 'bg-slate-100 px-2 py-1 rounded' }}">
                                    {{ \Carbon\Carbon::parse($sub->date_fin)->format('d/m/Y') }}
                                </span>
                            </div>
                        </td>

                        <td class="px-6 py-5 text-right">
                            @if($sub->statut === 'actif')
                                <span class="inline-flex items-center gap-1.5 text-[9px] font-black uppercase text-emerald-600 bg-emerald-50 border border-emerald-100 px-3 py-1 rounded-full">
                                    <span class="w-1 h-1 bg-emerald-600 rounded-full animate-pulse"></span>
                                    Actif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 text-[9px] font-black uppercase text-red-600 bg-red-50 border border-red-100 px-3 py-1 rounded-full">
                                    Expiré
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-24 text-center">
                            <p class="text-slate-300 font-black tracking-[5px] text-[10px] uppercase italic">
                                Aucun abonnement enregistré dans le système
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
            Administration System • BiblioTech Protocol • V2.0
        </p>
    </div>
</div>
@endsection