<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Emprunts | BiblioTech Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-slate-900 font-sans">

    <div class="flex flex-col md:flex-row min-h-screen">
        
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

        <main class="flex-1 p-4 md:p-10 bg-white">
            <div class="max-w-6xl mx-auto">
                
                <div class="mb-10 border-b-2 border-black pb-6">
                    <h1 class="text-3xl font-extrabold tracking-tighter uppercase text-black">Flux des Emprunts</h1>
                    <p class="text-[11px] text-gray-500 font-bold tracking-[3px] mt-1 uppercase">Supervision des retours et stock</p>
                </div>

                @if(session('success'))
                    <div class="mb-8 p-4 bg-white border-2 border-black text-xs font-black uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white border border-gray-200 rounded-sm overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left min-w-[800px]">
                            <thead class="bg-gray-50 border-b-2 border-gray-100">
                                <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[2px]">
                                    <th class="p-6">Lecteur</th>
                                    <th class="p-6">Ouvrage</th>
                                    <th class="p-6 text-center">Statut</th>
                                    <th class="p-6 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($emprunts as $emprunt)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="p-6">
                                        <div class="font-bold text-black text-sm">{{ $emprunt->user->name }}</div>
                                        <div class="text-[10px] text-gray-400 font-medium italic">{{ $emprunt->user->email }}</div>
                                    </td>
                                    <td class="p-6">
                                        <div class="text-xs font-bold border-l-4 border-black pl-3 py-1">
                                            {{ $emprunt->livre->titre }}
                                        </div>
                                    </td>

                                    <td class="p-6 text-center">
                                        @if($emprunt->statut == 'en_cours' || $emprunt->statut == 'en cours')
                                            <span class="px-3 py-1 text-[9px] font-black uppercase bg-orange-50 text-orange-600 border border-orange-200 rounded-full">
                                                En cours
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-[9px] font-black uppercase bg-green-50 text-green-600 border border-green-200 rounded-full">
                                                Rendu
                                            </span>
                                        @endif
                                    </td>

                                    <td class="p-6 text-right">
                                        @if($emprunt->statut == 'en_cours' || $emprunt->statut == 'en cours')
                                            <form action="{{ route('emprunts.retour', $emprunt->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Confirmer le retour ?')" 
                                                        class="border-2 border-black px-4 py-2 text-[10px] font-black uppercase tracking-tighter hover:bg-black hover:text-white transition-all duration-300">
                                                    Valider Retour
                                                </button>
                                            </form>
                                        @else
                                            <div class="text-right">
                                                <p class="text-gray-400 text-[9px] font-black uppercase tracking-widest">Le</p>
                                                <p class="text-black text-xs font-bold">
                                                    {{ $emprunt->date_retour ? \Carbon\Carbon::parse($emprunt->date_retour)->format('d/m/Y') : '–' }}
                                                </p>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="p-20 text-center">
                                        <p class="text-gray-300 font-black tracking-[5px] text-[10px] uppercase italic">
                                            Aucun flux d'emprunt actif
                                        </p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-16 text-center border-t border-gray-100 pt-8">
                    <p class="text-[9px] text-gray-400 font-black tracking-[5px] uppercase">
                        Zone Administrateur • BiblioTech Protocol
                    </p>
                </div>

            </div>
        </main>
    </div>

</body>
</html>