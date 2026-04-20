<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-black">

    <div class="flex flex-col md:flex-row min-h-screen overflow-x-hidden">
        
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

        <main class="flex-1 p-4 md:p-8 bg-white">
            <div class="max-w-6xl mx-auto">
                
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 border-b border-black pb-5 gap-4">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight">Catalogue</h1>
                        <p class="text-[10px] text-gray-500 font-bold tracking-[2px]">Total: {{ count($livres) }} Livres</p>
                    </div>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('livres.create') }}" class="w-full sm:w-auto text-center border-2 border-black px-5 py-2 text-xs font-bold hover:bg-black hover:text-white transition-colors">
                            + Ajouter un Livre
                        </a>
                    @endif
                </div>

                <div class="overflow-x-auto border border-gray-200 rounded-sm">
                    <table class="w-full text-left min-w-[600px]">
                        <thead class="bg-gray-100 border-b border-black text-[10px] font-black text-gray-600 uppercase">
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
                            <tr class="hover:bg-gray-50">
                                <td class="p-4">
                                    <div class="text-sm font-bold">{{ $livre->titre }}</div>
                                    <div class="text-[10px] text-gray-400 ">ISBN: {{ $livre->isbn }}</div>
                                </td>
                                <td class="p-4 text-xs text-center font-medium">{{ $livre->auteur->nom ?? '—' }}</td>
                                <td class="p-4 text-sm font-bold text-center text-slate-700">{{ number_format($livre->prix_emprunt, 2) }} DH</td>
                                <td class="p-4 text-center">
                                    <span class="text-[10px] font-black px-2 py-1 rounded-full border {{ $livre->quantite > 0 ? 'text-green-600 border-green-100 bg-green-50' : 'text-red-600 border-red-100 bg-red-50' }}">
                                        {{ $livre->quantite > 0 ? $livre->quantite : 'OUT' }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <div class="flex justify-end gap-3 text-[10px] font-bold">
                                        <a href="{{ route('livres.show', $livre->id) }}" class="text-blue-500 hover:underline">Voir</a>
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('livres.edit', $livre->id) }}" class="text-black hover:underline">Modifier</a>
                                            <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('Sûr ?')" class="text-red-600 hover:underline">Supprimer</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-10 text-center text-gray-400 text-xs font-bold">
                                    Catalogue Vide.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <p class="mt-12 text-center text-[10px] text-gray-400 tracking-[4px] uppercase">
                    BiblioTech Management System
                </p>

            </div>
        </main>
    </div>

</body>
</html>