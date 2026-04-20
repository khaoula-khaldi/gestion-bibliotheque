<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-slate-900">

    <div class="flex flex-col md:flex-row min-h-screen">
        
        <aside class="w-full md:w-64 bg-slate-800 text-white flex flex-col md:h-screen md:sticky md:top-0 z-50">
            <div class="p-5 md:p-6 border-b border-slate-700 flex justify-between items-center md:block">
                <h2 class="text-xl font-bold tracking-tight text-blue-400">BiblioTech</h2>
                <div class="md:hidden">
                    <span class="text-[9px] bg-slate-700 px-2 py-1 rounded uppercase font-bold text-slate-300">Emprunts</span>
                </div>
            </div>

            <nav class="flex-1 p-2 md:p-4 flex flex-row md:flex-col overflow-x-auto no-scrollbar items-center md:items-stretch gap-1 md:gap-2">
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" 
                   class="whitespace-nowrap px-4 py-2 md:p-3 hover:bg-slate-700 rounded text-gray-300 text-xs md:text-sm transition-colors">
                    Dashboard
                </a>
                
                <a href="{{ route('livres.index') }}" 
                   class="whitespace-nowrap px-4 py-2 md:p-3 hover:bg-slate-700 rounded text-gray-300 text-xs md:text-sm">
                    Catalogue
                </a>
                
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('users.index') }}" class="whitespace-nowrap px-4 py-2 md:p-3 hover:bg-slate-700 rounded text-gray-300 text-xs md:text-sm">Membres</a>
                    
                    <a href="{{ route('emprunts.index') }}" 
                       class="whitespace-nowrap px-4 py-2 md:p-3 hover:bg-slate-700 rounded text-gray-300 text-xs md:text-sm">
                        Gestion Emprunts
                    </a>

                    <a href="{{ route('subscriptions.index') }}" class="whitespace-nowrap px-4 py-2 md:p-3 hover:bg-slate-700 rounded text-gray-300 text-xs md:text-sm">Abonnements</a>
                    <a href="{{ route('auteurs.index') }}" class="whitespace-nowrap px-4 py-2 md:p-3 hover:bg-slate-700 rounded text-gray-300 text-xs md:text-sm">Auteurs</a>
                    <a href="{{ route('achats.index') }}" class="whitespace-nowrap px-4 py-2 md:p-3 hover:bg-slate-700 rounded text-gray-300 text-xs md:text-sm">Ventes</a>
                @endif
                
                <a href="/profile" class="whitespace-nowrap px-4 py-2 md:p-3 hover:bg-slate-700 rounded text-gray-300 text-xs md:text-sm">Profil</a>
            </nav>

            <div class="p-4 border-t border-slate-700 hidden md:block">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left p-3 text-red-400 hover:bg-red-500/10 rounded text-xs font-bold uppercase tracking-wider">
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 bg-slate-50/50 p-4 md:p-8 overflow-x-hidden">
            <div class="max-w-6xl mx-auto">
                
                <div class="mb-8 md:mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-slate-900">Bonjour, {{ auth()->user()->name }}</h1>
                        <p class="text-slate-500 mt-1 text-sm">Résumé de l'activité de votre bibliothèque.</p>
                    </div>
                    
                    @if(isset($lowStockLivres) && $lowStockLivres->count() > 0)
                        <div class="bg-red-50 border border-red-100 p-3 rounded-lg flex items-center gap-3 w-full md:w-auto">
                            <p class="text-red-800 text-xs font-bold">Alerte : {{ $lowStockLivres->count() }} ruptures.</p>
                            <a href="{{ route('livres.index') }}" class="text-[10px] font-black uppercase text-red-600 underline">Vérifier</a>
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-10">
                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h3 class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Livres en rayon</h3>
                        <p class="text-3xl md:text-4xl font-bold text-black mt-2">{{ $stats['total_livres'] ?? 0 }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h3 class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Abonnements Actifs</h3>
                        <p class="text-3xl md:text-4xl font-bold text-black mt-2">{{ $stats['total_actifs'] ?? 0 }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h3 class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Membres inscrits</h3>
                        <p class="text-3xl md:text-4xl font-bold text-black mt-2">{{ $stats['total_users'] ?? 0 }}</p>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
                    <div class="p-5 border-b flex flex-col md:flex-row justify-between items-start md:items-center gap-2 bg-slate-50/50">
                        <h2 class="text-sm font-bold text-slate-800">Derniers Abonnements</h2>
                        <a href="{{ route('subscriptions.index') }}" class="text-xs font-bold text-blue-600 hover:underline">Voir le registre →</a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-white">
                                    <th class="px-6 py-4 text-[10px] font-bold border-b uppercase text-slate-400 tracking-widest">Membre</th>
                                    <th class="px-6 py-4 text-[10px] font-bold border-b uppercase text-slate-400 tracking-widest">Plan</th>
                                    <th class="px-6 py-4 text-[10px] font-bold border-b uppercase text-slate-400 tracking-widest">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($recentSubscriptions ?? [] as $sub)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-slate-700">{{ $sub->user->name }}</td>
                                    <td class="px-6 py-4 text-[11px] text-slate-500 uppercase">{{ $sub->type }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded-full text-[9px] font-bold bg-green-50 text-green-700 border border-green-100 uppercase">
                                            {{ $sub->statut }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-slate-400 text-xs italic font-medium">Aucune donnée disponible pour le moment.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>