@extends('layouts.app')

@section('title', 'Mes Lectures')

@section('content')
    <div class="mb-10 border-b border-slate-200 pb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Mes Lectures</h1>
            <p class="text-slate-500 text-sm mt-1 font-medium">Suivez l'état de vos emprunts en cours et passés.</p>
        </div>
        
        @if($emprunts->count() > 0)
            <a href="{{ route('livres.catalogue') }}" class="inline-flex items-center text-xs font-black uppercase tracking-widest text-blue-600 hover:text-blue-800 transition">
                + Emprunter un autre livre
            </a>
        @endif
    </div>

    <div class="space-y-4">
        @forelse($emprunts as $emprunt)
            <div class="bg-white border border-slate-200 p-6 rounded-xl shadow-sm flex flex-col md:flex-row md:items-center justify-between group hover:border-blue-200 transition">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-slate-50 rounded-lg flex items-center justify-center text-slate-400 group-hover:text-blue-500 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 group-hover:text-blue-600 transition">{{ $emprunt->livre->titre }}</h3>
                        <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest mt-0.5">
                            Réf: #{{ str_pad($emprunt->id, 5, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                </div>

                <div class="mt-4 md:mt-0 flex items-center gap-6">
                    <div class="text-right">
                        @if($emprunt->statut == 'en_cours')
                            <span class="px-4 py-1.5 bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-amber-100 italic">
                                À rendre
                            </span>
                        @else
                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-emerald-100 italic">
                                Rendu
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="py-20 text-center bg-white border-2 border-dashed border-slate-200 rounded-3xl">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">Aucun emprunt pour le moment</h2>
                <p class="text-slate-500 text-sm mb-8 mt-2">Vous n'avez pas encore emprunté de livres dans notre catalogue.</p>
                <a href="{{ route('livres.catalogue') }}" class="bg-slate-900 text-white px-8 py-3 rounded-lg font-black text-[10px] uppercase tracking-[2px] hover:bg-blue-600 transition shadow-lg">
                    Parcourir le catalogue
                </a>
            </div>
        @endforelse
    </div>
@endsection