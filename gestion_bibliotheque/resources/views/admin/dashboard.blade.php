<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-slate-900">

    <div class="flex min-h-screen">
        
        <!-- 1. SIDEBAR (Simple & Dark) -->
        <aside class="w-64 bg-slate-800 text-white flex flex-col h-screen sticky top-0">
            <div class="p-6 border-b border-slate-700">
                <h2 class="text-xl font-bold">BiblioTech</h2>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Dashboard</a>
                <a href="{{ route('livres.index') }}" class="block p-3 bg-blue-600 text-white rounded">Catalogue Livres</a>
                
                @if(auth()->user()->role === 'admin')
                    <div class="text-xs text-gray-500 uppercase p-2">Admin Tools</div>
                    <a href="{{ route('users.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Membres</a>
                    <a href="{{ route('emprunts.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Emprunts</a>
                    <a href="{{ route('subscriptions.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Abonnements</a>
                    <a href="{{ route('livres.create') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Ajouter Livre</a>
                    <a href="{{ route('auteurs.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion auteurs</a>
                    <a href="{{ route('achats.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Ventes</a>
                    <a href="/profile" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Mon Profil</a>
                @endif
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left p-3 text-red-400 hover:bg-red-500/10 rounded">Déconnexion</button>
                </form>
            </div>
        </aside>

        <!-- 2. MAIN CONTENT -->
        <main class="flex-1 bg-slate-50/50 p-8">
            <div class="max-w-6xl mx-auto">
                
                <!-- Header Section -->
                <div class="mb-10 flex justify-between items-end">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Bonjour, {{ auth()->user()->name }}</h1>
                        <p class="text-slate-500 text-sm mt-1">Résumé de l'activité de votre bibliothèque.</p>
                    </div>
                </div>

                <!-- Alerte Stock -->
                @if(isset($lowStockLivres) && $lowStockLivres->count() > 0)
                <div class="bg-white border border-red-200 p-4 mb-8 rounded-lg flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-red-600 rounded-full animate-pulse"></div>
                        <p class="text-red-800 text-sm font-bold">Alerte : {{ $lowStockLivres->count() }} livres en rupture de stock.</p>
                    </div>
                    <a href="{{ route('livres.index') }}" class="text-xs font-bold text-red-600 hover:underline uppercase">Vérifier</a>
                </div>
                @endif

                <!-- Stats Cards (Borders only) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white p-6 rounded-xl border border-slate-200">
                        <h3 class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Livres en rayon</h3>
                        <p class="text-4xl font-black text-slate-900 mt-2">{{ $stats['total_livres'] ?? 0 }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-slate-200">
                        <h3 class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Abonnements Actifs</h3>
                        <p class="text-4xl font-black text-slate-900 mt-2">{{ $stats['total_actifs'] ?? 0 }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-slate-200">
                        <h3 class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Membres inscrits</h3>
                        <p class="text-4xl font-black text-slate-900 mt-2">{{ $stats['total_users'] ?? 0 }}</p>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
                    <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h2 class="text-sm font-bold text-slate-800 uppercase tracking-tight">Derniers Abonnements</h2>
                        <a href="{{ route('subscriptions.index') }}" class="text-xs font-bold text-blue-600 hover:underline">Voir le registre</a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-white">
                                    <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Membre</th>
                                    <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Plan</th>
                                    <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($recentSubscriptions ?? [] as $sub)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-semibold text-slate-700">{{ $sub->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-500 uppercase text-[11px] font-bold">{{ $sub->type }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase {{ $sub->statut === 'actif' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-slate-100 text-slate-600' }}">
                                            {{ $sub->statut }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-slate-400 text-sm">Aucune donnée disponible pour le moment.</td>
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