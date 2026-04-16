<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-black">

    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-slate-800 text-white flex flex-col h-screen sticky top-0">
            <div class="p-6 border-b border-slate-700">
                <h2 class="text-xl font-bold">BiblioTech</h2>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Dashboard</a>
                <a href="{{ route('livres.index') }}" class="block p-3 bg-slate-700 text-white rounded">Catalogue Livres</a>
                
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

        <main class="flex-1 h-full overflow-y-auto p-8 bg-white">
            <div class="max-w-6xl mx-auto">
                
                <div class="flex justify-between items-center mb-10 border-b border-black pb-5">
                    <div>
                        <h1 class="text-2xl font-bold  tracking-tight">Catalogue</h1>
                        <p class="text-[10px] text-gray-500 font-bold  tracking-[2px]">Total: {{ count($livres) }} Livres</p>
                    </div>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('livres.create') }}" class="border-2 border-black px-5 py-2 text-xs font-bold ">
                            + Ajouter
                        </a>
                    @endif
                </div>

                    <table class="w-full text-left">
                        <thead class="bg-gray-100 border-b border-black text-[10px] font-black   text-gray-600">
                            <tr>
                                <th class="p-4">Livre</th>
                                <th class="p-4 text-center">Auteur</th>
                                <th class="p-4 text-center">Prix</th>
                                <th class="p-4 text-center">Stock</th>
                                <th class="p-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($livres as $livre)
                            <tr class="">
                                <td class="p-4">
                                    <div class="text-sm font-bold">{{ $livre->titre }}</div>
                                    <div class="text-[10px] text-gray-400 ">ISBN: {{ $livre->isbn }}</div>
                                </td>
                                <td class="p-4 text-xs text-center font-medium">{{ $livre->auteur->nom ?? '—' }}</td>
                                <td class="p-4 text-sm font-bold text-center">{{ number_format($livre->prix_emprunt, 2) }} DH</td>
                                <td class="p-4 text-center">
                                    <span class="text-[10px] font-bold  {{ $livre->quantite > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $livre->quantite > 0 ? $livre->quantite : 'OUT' }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <div class="flex justify-end gap-4 text-[10px] font-bold ">
                                        <a href="{{ route('livres.show', $livre->id) }}" class="text-gray-400">Voir</a>
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('livres.edit', $livre->id) }}" class="text-black ">Modifier</a>
                                            <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('Sûr ?')" class="text-red-600">Supprimer</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-10 text-center text-gray-400 text-xs font-bold  ">
                                    Catalogue Vide.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                <p class="mt-12 text-center text-[10px] text-gray-400  tracking-[4px]">
                    BiblioTech Management System
                </p>

            </div>
        </main>
    </div>

</body>
</html>