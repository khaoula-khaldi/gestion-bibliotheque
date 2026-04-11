<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#f8fafc]">

    <div class="flex min-h-screen">
        <!-- SIDEBAR: Colors Stay, Icons Removed -->
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col sticky top-0 h-screen">
            <div class="p-8 text-center border-b border-slate-800">
                <h2 class="text-xl font-bold text-blue-400 uppercase tracking-wider">BiblioTech</h2>
            </div>
            <nav class="flex-1 px-4 space-y-1 mt-6">
                <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white font-bold text-xs uppercase tracking-widest">
                    Accueil
                </a>
                <a href="{{ route('livres.catalogue') }}" class="block px-4 py-3 rounded-xl text-gray-400 hover:bg-slate-800 hover:text-white font-bold text-sm uppercase tracking-wide">
                    Catalogue
                </a>
                <div class="h-[1px] bg-slate-800 my-4 mx-4"></div>
                <div class="h-[1px] bg-slate-800 my-4 mx-4"></div>

                @if(auth()->user()->role == 'admin')
                    <a href="{{ route('emprunts.index') }}" class="block px-4 py-3 rounded-xl text-gray-400 hover:bg-slate-800 hover:text-white font-bold text-sm uppercase tracking-wide">
                        Gestion Emprunts
                    </a>
                @else
                    <a href="{{ route('emprunts.mes_emprunts') }}" class="block px-4 py-3 rounded-xl text-gray-400 hover:bg-slate-800 hover:text-white font-bold text-sm uppercase tracking-wide">
                        Mes Emprunts
                    </a>
                @endif

                <a href="{{ route('achats.mes_achats') }}" class="block px-4 py-3 rounded-xl text-gray-400 hover:bg-slate-800 hover:text-white font-bold text-sm uppercase tracking-wide">
                        Mes Achats
                </a>

                <a href="/profile" class="block px-4 py-3 rounded-xl text-gray-400 hover:bg-slate-800 hover:text-white font-bold text-sm uppercase tracking-wide">Mon Profil</a>
            </nav>
                        <div class="p-4 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left p-3 text-red-400 hover:bg-red-500/10 rounded">Déconnexion</button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 md:p-10">
            <div class="max-w-6xl mx-auto">
                
                <!-- Welcome Section -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4 border-b border-slate-200 pb-8">
                    <div>
                        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Bonjour, {{ explode(' ', auth()->user()->name)[0] }}</h1>
                        <p class="text-slate-500 font-medium">Heureux de vous revoir sur BiblioTech.</p>
                    </div>
                    
                    @if($hasActiveSub)
                        <div class="bg-blue-600 text-white px-6 py-2 rounded-lg font-black text-xs uppercase tracking-widest">
                            Membre Premium
                        </div>
                    @else
                        <a href="{{ route('subscriptions.create') }}" class="bg-slate-900 text-white px-6 py-2 rounded-lg font-black text-xs uppercase tracking-widest hover:bg-blue-600 transition">
                            S'abonner (0€)
                        </a>
                    @endif
                </div>

                <!-- Stats Grid (No Shadow, Just Border) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 text-center">
                    <div class="bg-white p-8 rounded-2xl border border-slate-200">
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-2">Emprunts en cours</p>
                        <h3 class="text-3xl font-black text-slate-900">{{ $emprunts->count() }}</h3>
                    </div>
                    <div class="bg-white p-8 rounded-2xl border border-slate-200">
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-2">Total Achats</p>
                        <h3 class="text-3xl font-black text-slate-900">{{ $achats->count() }}</h3>
                    </div>
                    <div class="bg-white p-8 rounded-2xl border border-slate-200 flex flex-col justify-center">
                         <span class="text-xs font-black uppercase tracking-tighter {{ $hasActiveSub ? 'text-emerald-600' : 'text-slate-400' }}">
                            {{ $hasActiveSub ? 'Abonnement Actif' : 'Pas d\'abonnement' }}
                         </span>
                    </div>
                </div>

                <!-- Section: Recommendations -->
                <div class="mb-12">
                    <div class="flex justify-between items-center mb-6 px-2 border-l-4 border-blue-600 pl-4">
                        <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">Suggestions</h2>
                        <a href="{{ route('livres.catalogue') }}" class="text-blue-600 font-black text-xs uppercase tracking-widest">Voir tout</a>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                        @foreach($livres->take(6) as $livre)
                        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
                            <div class="aspect-[3/4] bg-slate-100 relative">
                                <img src="{{ $livre->image ? asset('storage/'.$livre->image) : 'https://via.placeholder.com/150' }}" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4 border-t border-slate-100 text-center">
                                <h4 class="font-bold text-slate-800 text-[10px] uppercase truncate">{{ $livre->titre }}</h4>
                                <div class="mt-2">
                                    @if($hasActiveSub && $livre->type === 'free')
                                        <span class="text-emerald-600 font-black text-[9px] uppercase">Gratuit</span>
                                    @else
                                        <span class="text-slate-900 font-black text-[10px]">{{ number_format($hasActiveSub ? $livre->prix_achat * 0.7 : $livre->prix_achat, 2) }} €</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Last Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white p-8 rounded-2xl border border-slate-200">
                        <h3 class="text-lg font-black text-slate-900 mb-6 uppercase tracking-tight border-b border-slate-100 pb-2">Mes Emprunts</h3>
                        <div class="divide-y divide-slate-100 text-sm">
                            @forelse($emprunts->take(3) as $emprunt)
                                <div class="py-3 flex justify-between items-center font-medium">
                                    <span class="text-slate-800">{{ $emprunt->livre->titre }}</span>
                                    <span class="text-slate-400 text-xs italic">Délai: {{ \Carbon\Carbon::parse($emprunt->date_retour)->format('d/m') }}</span>
                                </div>
                            @empty
                                <p class="text-slate-400 text-xs italic py-4">Rien à afficher.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Club Card -->
        
                </div>

            </div>
        </main>
    </div>
</body>
</html>