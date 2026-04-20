@extends('layouts.app')

@section('title', 'Emprunter un Livre')

@section('content')
    <div class="max-w-3xl mx-auto">
        
        <a href="{{ route('livres.catalogue') }}" class="text-slate-400 hover:text-slate-900 font-bold text-xs flex items-center gap-2 mb-8 transition group">
            <span class="group-hover:-translate-x-1 transition">←</span> Retour au catalogue
        </a>

        <div class="bg-white p-8 md:p-12 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40">
            <div class="mb-10 text-center">
                <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center text-4xl mx-auto mb-4 shadow-inner">
                    📖
                </div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Nouvel Emprunt</h1>
                <p class="text-slate-500 font-medium mt-2 text-sm italic">Choisissez votre prochain compagnon de route.</p>
            </div>

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 p-4 rounded-2xl mb-8 text-sm font-bold flex items-center gap-3 animate-pulse">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('emprunts.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-4 ml-2">Sélectionner le livre</label>
                    <div class="relative">
                        <select name="livre_id" required 
                                class="w-full bg-slate-50 border-2 border-slate-100 text-slate-900 text-sm font-bold rounded-2xl p-4 appearance-none focus:outline-none focus:border-blue-500 transition cursor-pointer">
                            <option value="" disabled selected>— Choisir un titre —</option>
                            @foreach($livres as $livre)
                                <option value="{{ $livre->id }}">
                                    {{ $livre->titre }} ({{ $livre->prix }} DH)
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-slate-900 rounded-[2rem] text-white relative overflow-hidden shadow-lg shadow-slate-900/20">
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-1">Avantage Membre</p>
                            <p class="text-xs text-slate-300 font-medium leading-relaxed">
                                Si vous avez un abonnement actif, <br> 
                                vous bénéficiez de <span class="text-white font-black italic underline decoration-blue-500">-50%</span> sur le prix.
                            </p>
                        </div>
                        <div class="text-3xl animate-bounce">✨</div>
                    </div>
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl"></div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-slate-900 text-white font-black py-5 rounded-2xl shadow-xl shadow-blue-600/20 transition transform hover:-translate-y-1 active:scale-95 text-xs uppercase tracking-[0.2em]">
                        Confirmer la Réservation
                    </button>
                </div>
            </form>

            <p class="text-center text-slate-400 text-[9px] font-bold mt-10 uppercase tracking-widest leading-loose">
                * Le paiement et le retrait se font sur place <br> sous réserve de disponibilité du livre.
            </p>
        </div>
    </div>
@endsection