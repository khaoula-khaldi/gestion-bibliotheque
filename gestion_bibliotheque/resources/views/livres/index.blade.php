<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow: hidden; }
    </style>
</head>
<body class="bg-white text-black">

    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-slate-800 text-white flex flex-col h-full sticky top-0">
            <div class="p-6 border-b border-slate-700 text-center">
                <h2 class="text-xl font-bold">BiblioTech</h2>
            </div>

            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300 text-sm">Dashboard</a>
                <a href="{{ route('livres.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300 text-sm">Catalogue Livres</a>
                
                @if(auth()->user()->role === 'admin')
                    <div class="h-[1px] bg-slate-700 my-4 mx-2"></div>
                    <a href="{{ route('users.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300 text-sm">Gestion Membres</a>
                    <a href="{{ route('emprunts.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300 text-sm">Gestion Emprunts</a>
                    <a href="{{ route('subscriptions.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300 text-sm">Abonnements</a>
                    <a href="{{ route('livres.create') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300 text-sm">Ajouter Livre</a>
                    <a href="{{ route('auteurs.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300 text-sm">Gestion auteurs</a>
                    <a href="{{ route('achats.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300 text-sm">Gestion Ventes</a>
                    <a href="/profile" class="block p-3 hover:bg-slate-700 rounded text-gray-300 text-sm">Mon Profil</a>
                @endif
            </nav>

            <div class="p-4 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left p-3 text-red-400 text-sm font-bold ">Déconnexion</button>
                </form>
            </div>
        </aside>

        <main class="flex-1 h-full overflow-y-auto p-8">
            <div class="max-w-6xl mx-auto">
                
                <div class="flex justify-between items-center mb-10 pb-6 border-b border-slate-100">
                    <div>
                        <h1 class="text-2xl font-black  text-">Catalogue</h1>
                        <p class="text-[10px] text-white font-bold   mt-1">Total: {{ count($livres) }} Livres</p>
                    </div>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('livres.create') }}" class="border border-10 px-5 py-2 text-[10px] font-black  hover:text-white ">
                            + Ajouter un Livre
                        </a>
                    @endif
                </div>

                <div class="border border-slate-200">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 border-b border-slate-200 text-[10px] font-black   text-white">
                            <tr>
                                <th class="p-4  text-black">Livre</th>
                                <th class="p-4 text-black text-center">Auteur</th>
                                <th class="p-4  text-black text-center">Prix</th>
                                <th class="p-4  text-black text-center">Stock</th>
                                <th class="p-4  text-black text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @forelse($livres as $livre)
                            <tr class="">
                                <td class="p-4">
                                    <div class="text-sm font-bold text-black ">{{ $livre->titre }}</div>
                                    <div class="text-[10px] text-white  mt-0.5">ISBN: {{ $livre->isbn }}</div>
                                </td>
                                <td class="p-4 text-xs text-slate-600  text-center">{{ $livre->auteur->nom ?? 'Inconnu' }}</td>
                                <td class="p-4 text-sm font-bold text-black text-center">{{ number_format($livre->prix_emprunt, 2) }} DH</td>
                                <td class="p-4 text-center">
                                    <span class="text-[10px] font-black  text-green-600">
                                        {{ $livre->quantite > 0 ? $livre->quantite : 'OUT' }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <div class="flex justify-end gap-3 text-[10px] font-black er">
                                        <a href="{{ route('livres.show', $livre->id) }}" class="text-white">Voir</a>
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('livres.edit', $livre->id) }}" class="text-blue-600">Modifier</a>
                                            <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('Supprimer ce livre ?')" class="text-red-500">Suppr.</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center text-white text-[10px] font-black">
                                    Aucun livre dans la base de données.
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