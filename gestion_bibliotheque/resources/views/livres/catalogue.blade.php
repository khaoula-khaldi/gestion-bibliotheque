@extends('layouts.app')

@section('title', 'Catalogue des Livres')

@section('content')
    <div class="max-w-7xl mx-auto">
        
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-12 gap-8">
            <div class="space-y-1">
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Catalogue</h1>
                <div class="flex items-center gap-3">
                    <span class="text-slate-500 text-sm font-medium">{{ $livres->count() }} livres disponibles</span>
                    @if(!$hasActiveSub)
                        <a href="{{ route('subscriptions.create') }}" class="text-blue-600 text-[10px] font-black uppercase tracking-widest hover:underline">
                            S'abonner 
                        </a>
                    @else
                        <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Abonnement Actif
                        </span>
                    @endif
                </div>
            </div>

            <div class="w-full lg:w-1/2 group">
                <form action="{{ route('livres.catalogue') }}" method="GET" class="flex items-center bg-white rounded-2xl p-1.5 shadow-sm border border-slate-200 focus-within:border-blue-500 transition-all">
                    <div class="relative flex-1">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                               placeholder="Titre, auteur, ISBN..." 
                               class="w-full bg-transparent border-none py-3 pl-12 pr-4 text-sm focus:ring-0 font-medium text-slate-700">
                    </div>
                    <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 transition">
                        Chercher
                    </button>
                </form>
            </div>
        </div>

        @if(session('error'))
            <div class="mb-8 bg-red-50 border border-red-100 p-4 rounded-2xl flex items-center gap-3 animate-bounce">
                <span class="text-red-500 text-xl">⚠️</span>
                <p class="text-red-700 text-sm font-bold">{{ session('error') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($livres as $livre)
                <div class="bg-white rounded-[2rem] border border-slate-100 overflow-hidden hover:shadow-2xl hover:shadow-slate-200 transition-all duration-300 group flex flex-col h-full">
                    
                    <div class="relative aspect-[3/4] overflow-hidden bg-slate-100 border-b border-slate-50">
                        <img src="{{ $livre->image ? asset('storage/'.$livre->image) : 'https://via.placeholder.com/300x400' }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                             alt="{{ $livre->titre }}">
                        
                        <div class="absolute top-4 right-4">
                            <span class="bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full text-[9px] font-black text-slate-900 uppercase tracking-tighter shadow-sm">
                                Premium
                            </span>
                        </div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col text-center">
                        <h3 class="font-black text-slate-900 text-lg leading-tight mb-1 group-hover:text-blue-600 transition">
                            {{ $livre->titre }}
                        </h3>
                        <p class="text-blue-500 text-[10px] font-black uppercase tracking-[0.2em]">
                            {{ $livre->auteur->nom ?? 'Auteur Inconnu' }}
                        </p>
                        
                        <div class="mt-auto pt-6 space-y-3">
                            <form action="{{ route('emprunts.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                <button class="w-full bg-slate-50 hover:bg-blue-600 hover:text-white text-slate-900 py-3.5 rounded-xl font-black text-[10px] uppercase tracking-widest flex justify-between px-5 transition-all group/btn shadow-sm">
                                    <span class="opacity-70 group-hover/btn:opacity-100">Réserver</span>
                                    <span class="font-bold">{{ number_format($livre->prix_final, 2) }} DH</span>
                                </button>
                            </form>

                            <form action="{{ route('achats.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                <button class="w-full bg-slate-900 hover:bg-slate-800 text-white py-3.5 rounded-xl font-black text-[10px] uppercase tracking-widest flex justify-between px-5 transition shadow-lg shadow-slate-900/10">
                                    <span class="text-slate-400">Acheter</span>
                                    <span class="text-blue-400 font-bold">{{ number_format($livre->prix_achat, 2) }} DH</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-32 text-center bg-white border-2 border-dashed border-slate-100 rounded-[3rem]">
                    <div class="text-5xl mb-4">🔍</div>
                    <p class="text-slate-400 font-bold text-sm uppercase tracking-widest">Aucun livre trouvé</p>
                    @if(request('keyword'))
                        <a href="{{ route('livres.catalogue') }}" class="text-blue-600 font-black text-xs mt-4 inline-block hover:underline">
                            RETOUR AU CATALOGUE COMPLET
                        </a>
                    @endif
                </div>
            @endforelse
        </div>
    </div>
@endsection