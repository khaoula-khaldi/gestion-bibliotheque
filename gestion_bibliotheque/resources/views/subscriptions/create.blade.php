@extends('layouts.app')

@section('title', 'S\'abonner')

@section('content')
    <div class="max-w-md mx-auto mt-10">
        
        <div class="mb-8 border-b border-slate-200 pb-6">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">S'abonner</h1>
            <p class="text-slate-500 text-sm mt-1 font-medium">Choisissez le forfait qui vous convient.</p>
        </div>

        <div class="bg-white border border-slate-200 p-8 shadow-sm rounded-xl">
            <form action="{{ route('subscriptions.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div>
                    <label for="type" class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-3">Choisir un forfait</label>
                    <div class="relative">
                        <select name="type" id="type" 
                                class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:border-blue-600 focus:bg-white outline-none appearance-none transition-all cursor-pointer">
                            <option value="mensuel">Mensuel — 9.99 Dh / mois</option>
                            <option value="annuel">Annuel — 89.99 Dh / an</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 p-4 rounded-lg flex items-center justify-between">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Compte</span>
                    <span class="text-xs font-bold text-slate-700">{{ $user->name }}</span>
                </div>

                <div class="space-y-4 pt-2">
                    <button type="submit" class="w-full bg-slate-900 text-white py-3.5 text-xs font-black uppercase tracking-[2px] hover:bg-blue-600 transition shadow-lg shadow-slate-900/10">
                        Confirmer l'abonnement
                    </button>

                    <a href="{{ route('dashboard') }}" class="block text-center text-xs font-bold text-slate-400 hover:text-slate-600 transition uppercase tracking-widest">
                        Annuler
                    </a>
                </div>
            </form>
        </div>

        <p class="mt-8 text-center text-[10px] text-slate-400 leading-relaxed px-4">
            L'accès à la bibliothèque sera activé immédiatement après la confirmation.
        </p>
    </div>
@endsection