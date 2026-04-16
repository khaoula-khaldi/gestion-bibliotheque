<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Emprunts | BiblioTech Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-slate-900 font-sans">

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

        <main class="flex-1 p-8 bg-white">
            <div class="max-w-6xl mx-auto">
                
                <div class="mb-10 border-b border-black pb-5">
                    <h1 class="text-2xl font-bold   text-black">Flux des Emprunts</h1>
                    <p class="text-[10px] text-gray-500 font-bold  ">Supervision des retours et stock</p>
                </div>

                @if(session('success'))
                    <div class="mb-8 p-4 border border-black bg-white text-xs font-bold ">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="border border-black -hidden ">
                    <table class="w-full text-left">
                        <thead class="bg-gray-100 border-b border-black text-[10px]  text-gray-600">
                            <tr>
                                <th class="p-6">Lecteur</th>
                                <th class="p-6">Ouvrage</th>
                                <th class="p-6 text-center">Prix</th>
                                <th class="p-6 text-center">Statut</th>
                                <th class="p-6 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($emprunts as $emprunt)
                            <tr class="hover:bg-gray-50 transition-none">
                                <td class="p-6">
                                    <p class="font-bold text-black text-sm">{{ $emprunt->user->name }}</p>
                                    <p class="text-[10px] text-gray-400 italic">{{ $emprunt->user->email }}</p>
                                </td>
                                <td class="p-6">
                                    <p class="text-xs font-medium border-l-2 border-black pl-3 italic">{{ $emprunt->livre->titre }}</p>
                                </td>
                                <td class="p-6 text-center">
                                    <p class="font-bold text-sm">{{ number_format($emprunt->prix, 2) }} DH</p>
                                </td>
                                <td class="p-6 text-center">
                                    @if($emprunt->statut == 'en_cours' || $emprunt->statut == 'en cours')
                                        <span class="px-3 py-1 text-[10px] font-bold  bg-orange-50 text-orange-600 border border-orange-100">
                                            En cours
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-[10px] font-bold  bg-green-50 text-green-600 border border-green-100">
                                            Rendu
                                        </span>
                                    @endif
                                </td>
                                <td class="p-6 text-right">
                                    @if($emprunt->statut == 'en_cours' || $emprunt->statut == 'en cours')
                                        <form action="{{ route('emprunts.retour', $emprunt->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Confirmer le retour ?')" class="border-2 border-black px-4 py-2 text-[10px] font-bold  hover:bg-black hover:text-white transition-none">
                                                Valider Retour
                                            </button>
                                        </form>
                                    @else
                                        <div class="text-right">
                                            <p class="text-gray-400 text-[9px] font-bold  tracking-widest">Le</p>
                                            <p class="text-black text-xs font-bold">{{ $emprunt->date_retour ? \Carbon\Carbon::parse($emprunt->date_retour)->format('d/m/Y') : '–' }}</p>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-20 text-center">
                                    <p class="text-gray-400 font-bold  tracking-widest text-xs italic">Aucune donnée disponible</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <p class="mt-12 text-center text-[10px] text-gray-400  tracking-[4px] font-bold">
                    Zone Administrateur • BiblioTech
                </p>

            </div>
        </main>
    </div>

</body>
</html>