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
        
        <aside class="w-64 bg-slate-800 text-white flex flex-col h-screen  top-0">
            <div class="p-6 border-b border-slate-700">
                <h2 class="text-xl font-bold">BiblioTech</h2>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Dashboard</a>
                <a href="{{ route('livres.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Catalogue Livres</a>
                
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('users.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Membres</a>
                    <a href="{{ route('emprunts.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Emprunts</a>
                    <a href="{{ route('subscriptions.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Abonnements</a>
                    <a href="{{ route('livres.create') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Ajouter Livre</a>
                    <a href="{{ route('auteurs.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion auteurs</a>
                    <a href="{{ route('achats.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Ventes</a>
                    <a href="/profile" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Mon Profil</a>
                @endif
            </nav>

            <div class="p-4 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left p-3 text-red-400 rounded">Déconnexion</button>
                </form>
            </div>
        </aside>

  
        <main class="flex-1 bg-slate-50/50 p-8">
            <div class="max-w-6xl mx-auto">
                
                <!-- Header Section -->
                <div class="mb-10 flex justify-between items-end">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900 ">Bonjour, {{ auth()->user()->name }}</h1>
                        <p class="text-slate-500 mt-1">Résumé de l'activité de votre bibliothèque.</p>
                    </div>
                </div>

                @if(isset($lowStockLivres) && $lowStockLivres->count() > 0)
                    <div class="flex items-center gap-3">
                        <p class="text-red-800 text-sm font-bold">Alerte : {{ $lowStockLivres->count() }} livres en rupture de stock.</p>
                    </div>
                    <a href="{{ route('livres.index') }}" class="text-xs font-bold text-red-600 ">Vérifier</a>
              
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white p-6 rounded-xl border border-slate-200">
                        <h3 class=" text-[10px] font-bold  ">Livres en rayon</h3>
                        <p class="text-4xl text-black mt-2">{{ $stats['total_livres'] ?? 0 }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-slate-200">
                        <h3 class=" text-[10px] font-bold  ">Abonnements Actifs</h3>
                        <p class="text-4xl text-black mt-2">{{ $stats['total_actifs'] ?? 0 }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-slate-200">
                        <h3 class=" text-[10px] font-bold  ">Membres inscrits</h3>
                        <p class="text-4xl text-black mt-2">{{ $stats['total_users'] ?? 0 }}</p>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="bg-white border border-slate-200 rounded-xl ">
                    <div class="p-5 border-b flex justify-between items-center bg-slate-50/50">
                        <h2 class="text-sm font-bold text-slate-800  ">Derniers Abonnements</h2>
                        <a href="{{ route('subscriptions.index') }}" class="text-xs font-bold text-blue-600">Voir le registre</a>
                    </div>
                    
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-white">
                                    <th class="px-6 py-4 text-[10px] font-bold border-b">Membre</th>
                                    <th class="px-6 py-4 text-[10px] font-bold border-b">Plan</th>
                                    <th class="px-6 py-4 text-[10px] font-bold border-b">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @forelse($recentSubscriptions ?? [] as $sub)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 text-sm ">{{ $sub->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-[11px] ">{{ $sub->type }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded text-[10px]  text-green-700  }}">
                                            {{ $sub->statut }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center  text-sm">Aucune donnée disponible pour le moment.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                </div>

            </div>
        </main>
    </div>

</body>
</html>