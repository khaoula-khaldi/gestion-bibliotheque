<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnements | BiblioTech</title>
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
                    <h1 class="text-3xl font-extrabold tracking-tighter uppercase text-black">Abonnements</h1>
                    <p class="text-[11px] text-gray-500 font-bold tracking-[3px] mt-1 uppercase">Membres et validité des comptes</p>
                </div>

                <div class="bg-white border border-gray-200 rounded-sm overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left min-w-[750px]">
                            <thead class="bg-gray-50 border-b-2 border-gray-100">
                                <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[2px]">
                                    <th class="p-6">Membre</th>
                                    <th class="p-6 text-center">Type</th>
                                    <th class="p-6">Période</th>
                                    <th class="p-6 text-right">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($subscriptions as $sub)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="p-6">
                                        <div class="text-sm font-bold text-black">{{ $sub->user->name }}</div>
                                        <div class="text-[10px] text-gray-400 font-medium">{{ $sub->user->email }}</div>
                                    </td>
                                    <td class="p-6 text-center">
                                        <span class="inline-block px-3 py-1 text-[9px] font-black uppercase border-2 border-black {{ $sub->type === 'annuel' ? 'bg-black text-white' : 'bg-white text-black' }}">
                                            {{ $sub->type }}
                                        </span>
                                    </td>
                                    <td class="p-6 text-xs font-bold text-black">
                                        <div class="flex items-center gap-2">
                                            <span>{{ \Carbon\Carbon::parse($sub->date_debut)->format('d/m/Y') }}</span>
                                            <span class="text-gray-300">→</span>
                                            <span>{{ \Carbon\Carbon::parse($sub->date_fin)->format('d/m/Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="p-6 text-right">
                                        @if($sub->statut === 'actif')
                                            <span class="text-[9px] font-black uppercase text-green-700 bg-green-50 border border-green-200 px-3 py-1 rounded-full">Actif</span>
                                        @else
                                            <span class="text-[9px] font-black uppercase text-red-700 bg-red-50 border border-red-200 px-3 py-1 rounded-full">Expiré</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="p-20 text-center">
                                        <p class="text-gray-300 font-black tracking-[5px] text-[10px] uppercase italic">
                                            Aucun abonnement enregistré
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
                        Administration System • BiblioTech Protocol
                    </p>
                </div>

            </div>
        </main>
    </div>

</body>
</html>