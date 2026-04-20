@extends('layouts.guest')

@section('content')
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-slate-900">BiblioTech</h2>
        <p class="text-slate-500 text-sm mt-2">Bon retour parmi nous.</p>
    </div>

    @if (session('status'))
        <div class="mb-4 p-3 bg-blue-50 text-blue-600 text-xs font-bold text-center">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label class="block text-[11px] font-bold text-slate-400 uppercase mb-2">Adresse E-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required 
                   placeholder="nom@exemple.com"
                   class="w-full px-4 py-2 border border-slate-200 text-sm focus:border-blue-600 outline-none">
            @if($errors->has('email'))
                <p class="text-red-500 text-[10px] mt-1">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div>
            <div class="flex justify-between mb-2">
                <label class="block text-[11px] font-bold text-slate-400 uppercase">Mot de passe</label>
            </div>
            <input type="password" name="password" required 
                   placeholder="••••••••"
                   class="w-full px-4 py-2 border border-slate-200 text-sm focus:border-blue-600 outline-none">
            @if($errors->has('password'))
                <p class="text-red-500 text-[10px] mt-1">{{ $errors->first('password') }}</p>
            @endif
        </div>

        <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3 text-xs uppercase tracking-widest">
            Se connecter
        </button>
    </form>

    <p class="text-center mt-8 text-sm text-slate-500">
        Pas encore de compte ? 
        <a href="{{ route('register') }}" class="text-blue-600 font-bold">S'inscrire gratuitement</a>
    </p>
@endsection