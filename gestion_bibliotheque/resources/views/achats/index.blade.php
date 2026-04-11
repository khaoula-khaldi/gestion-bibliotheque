<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Ventes | BiblioTech</title>
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

        <!-- MAIN CONTENT -->
        <main class="flex-1 bg-white p-8">
            <div class="max-w-5xl mx-auto">
                
                <!-- Header Simple -->
                <div class="flex justify-between items-end mb-10">
                    <div>
                        <h1 class="text-xl font-bold text-slate-900">Registre des Ventes</h1>
                        <p class="text-slate-400 text-xs mt-1 font-medium">Historique global des transactions.</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Chiffre d'Affaires</p>
                        <p class="text-2xl font-black text-slate-900">{{ number_format($achats->sum('prix'), 2) }} <span class="text-xs">DH</span></p>
                    </div>
                </div>

                <!-- Stats Rapides (Modern & Minimal) -->
                <div class="grid grid-cols-3 gap-6 mb-10">
                    <div class="border-l-2 border-blue-500 pl-4">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Total Ventes</p>
                        <p class="text-lg font-bold text-slate-800">{{ $achats->count() }}</p>
                    </div>
                    <div class="border-l-2 border-slate-200 pl-4">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Ce mois</p>
                        <p class="text-lg font-bold text-slate-800">{{ $achats->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                    </div>
                    <div class="border-l-2 border-slate-200 pl-4">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Membres Actifs</p>
                        <p class="text-lg font-bold text-slate-800">{{ $achats->unique('user_id')->count() }}</p>
                    </div>
                </div>

                <!-- Table Minimaliste -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-slate-100">
                                <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Client</th>
                                <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Ouvrage</th>
                                <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Montant</th>
                                <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-wider text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($achats as $achat)
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="py-4">
                                    <span class="text-sm font-bold text-slate-700 group-hover:text-blue-600 transition-colors">{{ $achat->user->name }}</span>
                                </td>
                                <td class="py-4">
                                    <div class="text-sm text-slate-600">{{ $achat->livre->titre }}</div>
                                </td>
                                <td class="py-4">
                                    <span class="text-sm font-black text-slate-900">{{ number_format($achat->prix, 2) }} DH</span>
                                </td>
                                <td class="py-4 text-right">
                                    <span class="text-xs font-medium text-slate-400">{{ $achat->created_at->format('d/m/Y') }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-20 text-center">
                                    <p class="text-slate-400 text-sm font-medium italic">Aucune transaction trouvée.</p>
                                </td>
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