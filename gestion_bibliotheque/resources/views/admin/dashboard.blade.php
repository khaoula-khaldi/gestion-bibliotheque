@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-8">
    
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Bonjour, {{ auth()->user()->name }} </h1>
            <p class="text-gray-500 text-sm">Voici ce qui se passe dans votre bibliothèque aujourd'hui.</p>
        </div>
        
        @if(isset($lowStockLivres) && $lowStockLivres->count() > 0)
            <div class="bg-red-500 text-white px-4 py-2 rounded-lg text-xs font-bold ">
                {{ $lowStockLivres->count() }} Livres en rupture !
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <div class="bg-blue-600 p-6 rounded-2xl text-white shadow-sm">
            <p class="text-blue-100 text-xs font-bold uppercase tracking-wider">Livres</p>
            <p class="text-3xl font-bold mt-1">{{ $stats['total_livres'] ?? 0 }}</p>
        </div>

        <div class="bg-emerald-500 p-6 rounded-2xl text-white shadow-sm">
            <p class="text-emerald-100 text-xs font-bold uppercase tracking-wider">Abonnés</p>
            <p class="text-3xl font-bold mt-1">{{ $stats['total_actifs'] ?? 0 }}</p>
        </div>

        <div class="bg-slate-800 p-6 rounded-2xl text-white shadow-sm">
            <p class="text-slate-300 text-xs font-bold uppercase tracking-wider">Membres</p>
            <p class="text-3xl font-bold mt-1">{{ $stats['total_users'] ?? 0 }}</p>
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-gray-700">Derniers Abonnements</h3>
            <a href="{{ route('subscriptions.index') }}" class="text-blue-600 text-xs font-bold hover:underline">Voir tout →</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-400 text-[10px] uppercase font-bold tracking-widest bg-gray-50/50">
                        <th class="px-6 py-4">Membre</th>
                        <th class="px-6 py-4">Plan</th>
                        <th class="px-6 py-4 text-right">Statut</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($recentSubscriptions ?? [] as $sub)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50">
                        <td class="px-6 py-4 font-semibold text-gray-700">{{ $sub->user->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $sub->type }}</td>
                        <td class="px-6 py-4 text-right">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-bold">
                                {{ $sub->statut }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-gray-400 italic">Rien à signaler.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection