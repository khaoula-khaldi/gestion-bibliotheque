<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Utilisateurs | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-50 text-slate-900">

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
                    <h1 class="text-3xl font-extrabold tracking-tighter uppercase text-black">Gestion des Membres</h1>
                    <p class="text-[11px] text-gray-500 font-bold tracking-[3px] mt-1">TOTAL: {{ $users->count() }} UTILISATEURS</p>
                </div>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-600 text-green-800 text-xs font-bold shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white border border-gray-200 rounded-sm overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left min-w-[600px]">
                            <thead class="bg-gray-50 border-b-2 border-gray-100">
                                <tr class="text-[10px] font-black text-gray-400 uppercase tracking-wider">
                                    <th class="px-6 py-4">Utilisateur</th>
                                    <th class="px-6 py-4 text-center">Statut</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($users as $user)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-black">{{ $user->name }}</div>
                                        <div class="text-[10px] text-gray-400 font-medium italic">{{ $user->email }}</div>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-block px-3 py-1 rounded-full text-[9px] font-black border uppercase {{ $user->is_active ? 'bg-green-50 text-green-700 border-green-200' : 'bg-red-50 text-red-700 border-red-200' }}">
                                            {{ $user->is_active ? 'Actif' : 'Banni' }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('users.toggle', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-[9px] font-black uppercase tracking-widest border-2 border-black px-4 py-2 hover:bg-black hover:text-white transition-all duration-300">
                                                {{ $user->is_active ? 'Bannir' : 'Activer' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-12 text-center">
                    <p class="text-[9px] text-gray-400 font-black tracking-[5px] uppercase italic">
                        BiblioTech Security Layer
                    </p>
                </div>
            </div>
        </main>
    </div>

</body>
</html>