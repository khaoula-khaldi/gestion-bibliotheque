@extends('layouts.app')

@section('title', 'Mon Espace')

@section('content')
    <div class="mb-12 border-b border-slate-100 pb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Bonjour, {{ auth()->user()->name }}</h1>
            <p class="text-slate-500 text-sm mt-1">Tableau de bord BiblioTech.</p>
        </div>

        <div class="mt-4">
            @if(!$hasActiveSub)
                <a href="{{ route('subscriptions.create') }}" class="border border-slate-900 px-6 py-2 text-[10px] font-black uppercase tracking-widest hover:bg-slate-900 hover:text-white transition">
                    S'abonner (0 Dh)
                </a>
            @else
                <span class="text-[10px] font-black uppercase tracking-widest text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded">
                    ✓ Abonnement Actif
                </span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-12">
        <div class="border border-slate-200 p-8 text-center bg-white shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Emprunts</p>
            <h3 class="text-3xl font-bold text-slate-900">{{ $emprunts->count() }}</h3>
        </div>

        <div class="border border-slate-200 p-8 text-center bg-white shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Achats</p>
            <h3 class="text-3xl font-bold text-slate-900">{{ $achats->count() }}</h3>
        </div>
    </div>

    <section class="mb-12">
        <h2 class="text-xs font-black text-black mb-6 uppercase tracking-widest border-l-4 border-slate-900 pl-3">
            Derniers Emprunts
        </h2>
        
        <div class="bg-white border border-slate-100 divide-y divide-slate-50">
            @forelse($emprunts->take(3) as $emprunt)
                <div class="py-4 px-6 flex justify-between items-center hover:bg-slate-50 transition">
                    <span class="text-sm font-medium text-slate-700">{{ $emprunt->livre->titre }}</span>
                    <span class="text-[10px] text-slate-400 font-bold italic uppercase tracking-tighter">En cours</span>
                </div>
            @empty
                <div class="py-10 text-center">
                    <p class="text-xs text-slate-400">Aucune activité pour le moment.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection