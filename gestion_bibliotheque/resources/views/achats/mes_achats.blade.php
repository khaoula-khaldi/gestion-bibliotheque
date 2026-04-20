@extends('layouts.app')

@section('title', 'Mes Achats')

@section('content')
    <div class="max-w-4xl mx-auto">

        <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-slate-100 pb-8">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Mes Livres Achetés</h1>
                <p class="text-slate-500 text-sm mt-1 font-medium">L'historique complet de vos acquisitions.</p>
            </div>
            
            <div class="bg-white px-6 py-3 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-3">
                <div class="flex flex-col">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Collection</span>
                    <span class="text-2xl font-black text-blue-600 leading-none">{{ $achats->count() }}</span>
                </div>
            </div>
        </div>

        <div class="grid gap-4">
            @forelse($achats as $achat)
                <div class="bg-white rounded-2xl border border-slate-100 p-6 flex flex-col md:flex-row items-center justify-between hover:shadow-md transition group shadow-sm">

                    <div class="flex items-center gap-5 w-full md:w-auto">
                        <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-blue-50 group-hover:text-blue-500 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        
                        <div>
                            <h3 class="font-bold text-slate-800 group-hover:text-blue-600 transition">{{ $achat->livre->titre }}</h3>
                            <p class="text-[11px] text-slate-400 font-bold mt-0.5 tracking-wide">
                                ACHETÉ LE {{ $achat->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between md:justify-end w-full md:w-auto mt-4 md:mt-0 gap-8 border-t md:border-0 pt-4 md:pt-0 border-slate-50">
                        <div class="text-left md:text-right">
                            <span class="block text-lg font-black text-slate-900">{{ number_format($achat->prix, 2) }} DH</span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-lg border border-emerald-100">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                Payé
                            </span>
                        </div>
                        
                        <button class="p-2 text-slate-300 hover:text-slate-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="py-24 text-center bg-white rounded-[2.5rem] border-2 border-dashed border-slate-100">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-200">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">Votre panier est vide</h2>
                    <p class="text-slate-500 text-sm mb-8 mt-2">Vous n'avez pas encore fait d'achats définitifs.</p>
                    <a href="{{ route('livres.catalogue') }}" class="bg-slate-900 text-white px-10 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[2px] hover:bg-blue-600 transition shadow-xl shadow-slate-200">
                        Parcourir le catalogue
                    </a>
                </div>
            @endforelse
        </div>
    </div>
@endsection