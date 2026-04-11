<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Livres | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

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

        <main class="flex-1 p-8">
            <div class="max-w-6xl mx-auto">
                
                <div class="flex justify-between items-center mb-10 pb-6 border-b border-gray-100">
                    <h1 class="text-3xl font-black text-gray-900">Catalogue des Livres</h1>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('livres.create') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded font-bold hover:bg-blue-700 shadow-lg">
                            + Ajouter un Livre
                        </a>
                    @endif
                </div>

                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden flex flex-col">
                    
                    <table class="w-full text-left border-collapse text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="p-4 font-bold text-gray-600">Livre</th>
                                <th class="p-4 font-bold text-gray-600 uppercase text-xs">Auteur</th>
                                <th class="p-4 font-bold text-gray-600">Prix</th>
                                <th class="p-4 font-bold text-gray-600 uppercase text-xs">Stock</th>
                                <th class="p-4 font-bold text-gray-600 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($livres as $livre)
                            <tr class="hover:bg-gray-50/50">
                                
                                <td class="p-4">
                                    <div class="text-gray-900 font-bold">{{ $livre->titre }}</div>
                                    <div class="text-[11px] text-gray-400 font-mono tracking-tight">ISBN: {{ $livre->isbn }}</div>
                                </td>
                                
                                <td class="p-4 text-gray-600 italic text-sm">{{ $livre->auteur->nom }}</td>
                                
                                <td class="p-4 text-blue-600 font-bold text-base">{{ number_format($livre->prix_emprunt, 2) }} DH</td>
                                
                                <td class="p-4">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $livre->quantite > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $livre->quantite > 0 ? $livre->quantite . ' en stock' : 'Épuisé' }}
                                    </span>
                                </td>
                                
                                <td class="p-4 text-right flex justify-end gap-3 text-xs font-bold uppercase">
                                    <a href="{{ route('livres.show', $livre->id) }}" class="text-gray-500 hover:text-gray-900">Voir</a>
                                    
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('livres.edit', $livre->id) }}" class="text-blue-600 hover:text-blue-800">Modifier</a>
                                        <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Confirmer ?')" class="text-red-500 hover:text-red-700">Supprimer</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-10 text-center text-gray-400 italic">Aucun livre trouvé.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 links-minimalist">
                    {{ $livres->links() }}
                </div>
            </div>
        </main>
    </div>

</body>
</html>