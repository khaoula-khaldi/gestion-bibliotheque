@extends('layouts.app')

@section('title', 'Gestion des Membres')

@section('content')
<div class="max-w-6xl mx-auto">
    
    <div class="mb-10 border-b border-slate-200 pb-6">
        <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Gestion des Membres</h1>
        <p class="text-[10px] text-slate-400 font-bold tracking-[3px] mt-1 uppercase">
            Total: {{ $users->count() }} Utilisateurs enregistrés
        </p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 text-[10px] font-black uppercase tracking-widest shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-slate-200 rounded-sm shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[600px]">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-[10px] font-black text-slate-500 uppercase tracking-widest">
                        <th class="px-6 py-4">Informations Utilisateur</th>
                        <th class="px-6 py-4 text-center">Statut du Compte</th>
                        <th class="px-6 py-4 text-right">Actions de Sécurité</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-slate-800 text-white rounded-full flex items-center justify-center text-[10px] font-black uppercase">
                                    {{ substr($user->name, 0, 2) }}
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-slate-900">{{ $user->name }}</div>
                                    <div class="text-[10px] text-slate-400 font-medium tracking-wide">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-5 text-center">
                            <span class="inline-block px-3 py-1 rounded-full text-[9px] font-black border uppercase tracking-tighter {{ $user->is_active ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-red-50 text-red-600 border-red-100' }}">
                                {{ $user->is_active ? 'Compte Actif' : 'Accès Restreint' }}
                            </span>
                        </td>

                        <td class="px-6 py-5 text-right">
                            <form action="{{ route('users.toggle', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                    class="text-[9px] font-black uppercase tracking-widest px-5 py-2 border-2 border-slate-900 transition-all duration-200 {{ $user->is_active ? 'hover:bg-red-600 hover:border-red-600 hover:text-white text-slate-900' : 'hover:bg-emerald-600 hover:border-emerald-600 hover:text-white text-slate-900' }}">
                                    {{ $user->is_active ? 'Bannir l\'utilisateur' : 'Réactiver l\'accès' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-20 text-center">
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-[3px]">Aucun membre trouvé</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-12 text-center">
        <p class="text-[9px] text-slate-300 font-black tracking-[5px] uppercase italic">
            BiblioTech Security Layer • Access Control List
        </p>
    </div>
</div>
@endsection