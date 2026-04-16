<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auteurs | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-slate-900 font-sans">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-800 text-white flex flex-col h-screen sticky top-0">
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

        <main class="flex-1 p-10 bg-white">
            <div class="max-w-5xl mx-auto">
                
                @if(session('success'))
                    <div class="mb-8 p-4 border border-black bg-white text-[10px] font-bold ">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-10 border-b border-black pb-5">
                    <div>
                        <h1 class="text-2xl font-bold text-black">Gestion des Auteurs</h1>
                        <p class="text-[10px] text-gray-500 font-bold  ">Base de données des auteurs</p>
                    </div>
                    <a href="{{ route('auteurs.create') }}" class="border-2 border-black px-5 py-2 text-[10px] font-bold  hover:bg-black hover:text-white transition-none">
                        + Ajouter
                    </a>
                </div>

                    <table class="w-full text-left">
                        <thead class="bg-gray-100 border-b border-black text-[10px] font-black   text-gray-600">
                            <tr>
                                <th class="p-6">Nom de l'Auteur</th>
                                <th class="p-6">Date de Naissance</th>
                                <th class="p-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @forelse($auteurs as $auteur)
                            <tr class="">
                                <td class="p-6 text-sm font-bold text-black ">
                                    {{ $auteur->nom }} {{ $auteur->prenom }}
                                </td>
                                <td class="p-6 text-xs text-gray-500">
                                    {{ $auteur->date_naissance ? \Carbon\Carbon::parse($auteur->date_naissance)->format('d/m/Y') : '—' }}
                                </td>
                                <td class="p-6 text-right">
                                    <div class="flex justify-end gap-4 text-[10px] font-bold ">
                                        <a href="{{ route('auteurs.edit', $auteur->id) }}" class="text-black ">Modifier</a>
                                        <form action="{{ route('auteurs.destroy', $auteur->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Confirmer la suppression ?')" class="text-red-600">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="p-20 text-center text-gray-400 text-xs font-bold ">
                                    Aucun auteur trouvé.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>




            </div>
        </main>
    </div>

</body>
</html>