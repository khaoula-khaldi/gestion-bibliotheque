<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Ventes | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-white text-slate-900">

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

        <main class="flex-1 bg-white p-4 md:p-10 min-h-screen">
            <div class="max-w-5xl mx-auto">
                
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-10 border-b border-gray-100 pb-8 gap-6">
                    <div>
                        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight uppercase">Registre des Ventes</h1>
                        <p class="text-slate-400 text-xs mt-1 font-bold tracking-widest uppercase">Historique global des transactions</p>
                    </div>
                    <div class="w-full sm:w-auto text-left sm:text-right bg-slate-900 p-4 rounded-lg text-white shadow-xl">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Chiffre d'Affaires Global</p>
                        <p class="text-3xl font-light">{{ number_format($achats->sum('prix'), 2) }} <span class="text-sm font-bold text-blue-400">DH</span></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-8 mb-12">
                    <div class="bg-slate-50 p-6 rounded-xl border border-slate-100 shadow-sm">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1">Total Ventes</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $achats->count() }}</p>
                    </div>
                    <div class="bg-slate-50 p-6 rounded-xl border border-slate-100 shadow-sm">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1">Ce mois-ci</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $achats->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                    </div>
                    <div class="bg-slate-50 p-6 rounded-xl border border-slate-100 shadow-sm">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1">Membres Actifs</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $achats->unique('user_id')->count() }}</p>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left min-w-[600px]">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-100">
                                    <th class="p-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Client</th>
                                    <th class="p-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Ouvrage</th>
                                    <th class="p-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Montant</th>
                                    <th class="p-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($achats as $achat)
                                <tr class="group hover:bg-slate-50/50 transition-colors">
                                    <td class="p-5">
                                        <div class="text-sm font-bold text-slate-700">{{ $achat->user->name }}</div>
                                    </td>
                                    <td class="p-5">
                                        <div class="text-sm text-slate-500 font-medium italic">{{ $achat->livre->titre }}</div>
                                    </td>
                                    <td class="p-5">
                                        <span class="text-sm font-black text-slate-900">{{ number_format($achat->prix, 2) }} DH</span>
                                    </td>
                                    <td class="p-5 text-right">
                                        <span class="text-[11px] font-bold text-slate-400 uppercase">{{ $achat->created_at->format('d M Y') }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-20 text-center">
                                        <p class="text-slate-300 text-[10px] font-black uppercase tracking-[5px] italic">Aucune transaction indexée</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-12 text-center">
                    <p class="text-[9px] text-gray-300 font-black tracking-[8px] uppercase">
                        Financial Record System • BiblioTech
                    </p>
                </div>

            </div>
        </main>
    </div>

</body>
</html>