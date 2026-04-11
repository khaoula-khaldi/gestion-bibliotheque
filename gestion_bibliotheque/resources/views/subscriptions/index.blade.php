<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnements | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-slate-900">

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
        <main class="flex-1 p-10">
            <div class="max-w-6xl mx-auto">
                
                <div class="mb-10">
                    <h1 class="text-3xl font-extrabold text-slate-900">Abonnements</h1>
                    <p class="text-slate-500 mt-1">Liste des membres et validité des comptes.</p>
                </div>

                <!-- TABLE -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500 tracking-wider">Membre</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500 tracking-wider text-center">Type</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500 tracking-wider">Période</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500 tracking-wider text-right">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($subscriptions as $sub)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900">{{ $sub->user->name }}</div>
                                    <div class="text-xs text-slate-400">{{ $sub->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded text-[10px] font-bold uppercase {{ $sub->type === 'annuel' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ $sub->type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                                    {{ \Carbon\Carbon::parse($sub->date_debut)->format('d/m/Y') }} 
                                    <span class="mx-2 text-slate-300">→</span> 
                                    {{ \Carbon\Carbon::parse($sub->date_fin)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($sub->statut === 'actif')
                                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold">Actif</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">Expiré</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-20 text-center text-slate-400 italic">
                                    Aucun abonnement trouvé.
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