@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Paramètres du Profil</h1>
            <p class="text-slate-500 text-sm mt-1 font-medium">Gérez vos informations personnelles et la sécurité.</p>
        </div>
        
        @if(Auth::user()->role === 'admin')
            <div class="self-start">
                <span class="px-4 py-1.5 bg-blue-50 text-blue-600 border border-blue-100 rounded-full text-[10px] font-black uppercase tracking-widest">
                    Mode Admin
                </span>
            </div>
        @endif
    </div>

    <div class="space-y-8">
        
        <div class="bg-white p-6 md:p-8 rounded-2xl border border-slate-200 shadow-sm">
            <div class="max-w-xl">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-6 border-l-4 border-blue-600 pl-3">
                    Informations Publiques
                </h3>
                <div class="overflow-x-hidden">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-2xl border border-slate-200 shadow-sm">
            <div class="max-w-xl">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-6 border-l-4 border-slate-400 pl-3">
                    Sécurité du Compte
                </h3>
                <div class="overflow-x-hidden">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        @if(Auth::user()->role !== 'admin')
            <div class="bg-red-50/50 p-6 md:p-8 rounded-2xl border border-red-100 shadow-sm">
                <div class="max-w-xl">
                    <h3 class="text-sm font-black text-red-800 uppercase tracking-wider mb-6">
                        Zone de Danger
                    </h3>
                    <div class="overflow-x-hidden">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection