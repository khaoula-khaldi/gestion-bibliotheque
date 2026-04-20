<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BiblioTech')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .active-link { background-color: #1e293b; color: #60a5fa !important; }
    </style>
</head>
<body class="bg-gray-50">

    <div class="flex min-h-screen">
        
        <aside class="w-64 bg-slate-900 text-white flex flex-col sticky top-0 h-screen">
            <div class="p-8 border-b border-slate-800">
                <h2 class="text-xl font-bold tracking-wider text-blue-400">BiblioTech</h2>
            </div>

            <nav class="flex-1 px-2 mt-6 space-y-1">
                <a href="{{ route('dashboard') }}" 
                   class="block px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-white {{ request()->routeIs('dashboard') ? 'active-link' : '' }}">
                    Accueil
                </a>

                <a href="{{ route('livres.catalogue') }}" 
                   class="block px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-white {{ request()->routeIs('livres.catalogue') ? 'active-link' : '' }}">
                    Catalogue
                </a>

                <div class="h-[1px] bg-slate-800 my-4 mx-6"></div>

                @if(auth()->user()->role == 'admin')
                    <a href="{{ route('emprunts.index') }}" 
                       class="block px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-white {{ request()->routeIs('emprunts.index') ? 'active-link' : '' }}">
                        Gestion Emprunts
                    </a>
                @else
                    <a href="{{ route('emprunts.mes_emprunts') }}" 
                       class="block px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-white {{ request()->routeIs('emprunts.mes_emprunts') ? 'active-link' : '' }}">
                        Mes Emprunts
                    </a>
                @endif

                <a href="{{ route('achats.mes_achats') }}" 
                   class="block px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-white {{ request()->routeIs('achats.mes_achats') ? 'active-link' : '' }}">
                    Mes Achats
                </a>

                <a href="/profile" 
                   class="block px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-white {{ request()->is('profile*') ? 'active-link' : '' }}">
                    Mon Profil
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-6 py-3 text-xs font-bold uppercase tracking-widest text-red-400 hover:bg-red-900/20 transition">
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto">
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-end px-10 shadow-sm">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">
                    Utilisateur: <span class="text-slate-900">{{ auth()->user()->name }}</span>
                </span>
            </header>

            <div class="p-8">
                @yield('content')
            </div>
        </main>

    </div>

</body>
</html>