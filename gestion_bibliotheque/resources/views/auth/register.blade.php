@extends('layouts.guest')

@section('content')
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tighter">BiblioTech</h2>
        <p class="text-slate-500 text-sm mt-2">Créez votre compte pour commencer.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div class="space-y-1">
            <label for="name" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Nom complet</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus 
                   placeholder="Votre nom complet"
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 text-sm focus:border-blue-600 outline-none transition-all">
            @if($errors->has('name'))
                <p class="text-red-500 text-[10px] font-semibold mt-1">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div class="space-y-1">
            <label for="email" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Adresse E-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                   placeholder="nom@exemple.com"
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 text-sm focus:border-blue-600 outline-none transition-all">
            @if($errors->has('email'))
                <p class="text-red-500 text-[10px] font-semibold mt-1">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div class="space-y-1">
            <label for="password" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Mot de passe</label>
            <input id="password" type="password" name="password" required 
                   placeholder="••••••••"
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 text-sm focus:border-blue-600 outline-none transition-all">
            @if($errors->has('password'))
                <p class="text-red-500 text-[10px] font-semibold mt-1">{{ $errors->first('password') }}</p>
            @endif
        </div>

        <div class="space-y-1">
            <label for="password_confirmation" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required 
                   placeholder="••••••••"
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 text-sm focus:border-blue-600 outline-none transition-all">
        </div>

        <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3 text-xs uppercase tracking-widest hover:bg-blue-600 transition shadow-sm">
            S'inscrire
        </button>
    </form>

    <p class="text-center mt-8 text-sm text-slate-500 font-medium">
        Déjà inscrit ? 
        <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Se connecter</a>
    </p>
@endsection