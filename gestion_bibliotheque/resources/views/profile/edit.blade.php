<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50">

    <div class="flex min-h-screen">
        
        <!-- SIDEBAR LOGIC -->
        @if(Auth::user()->role === 'admin')
            <!-- SIDEBAR ADMIN -->
            <aside class="w-64 bg-slate-800 text-white flex flex-col h-screen sticky top-0">
                <div class="p-6 border-b border-slate-700">
                    <h2 class="text-xl font-bold">BiblioTech</h2>
                </div>

                <nav class="flex-1 p-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Dashboard</a>
                    <a href="{{ route('livres.index') }}" class="block p-3 bg-blue-600 text-white rounded">Catalogue Livres</a>
                    
                @if(auth()->user()->role === 'admin')
                    <div class="text-xs text-gray-500 uppercase p-2">Admin Tools</div>
                    <a href="{{ route('users.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Membres</a>
                    <a href="{{ route('emprunts.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Emprunts</a>
                    <a href="{{ route('subscriptions.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Abonnements</a>
                    <a href="{{ route('livres.create') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Ajouter Livre</a>
                    <a href="{{ route('auteurs.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion auteurs</a>
                    <a href="{{ route('achats.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Ventes</a>
                    <a href="/profile" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Mon Profil</a>
                @endif
                </nav>

                <!-- Logout -->
                <div class="p-4 border-t border-slate-700">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left p-3 text-red-400 hover:bg-red-500/10 rounded">Déconnexion</button>
                    </form>
                </div>
            </aside>
        @else
            <!-- SIDEBAR USER -->
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
        @endif

        <!-- MAIN CONTENT (L-imin) -->
        <main class="flex-1 p-6 md:p-12 overflow-y-auto">
            <div class="max-w-4xl mx-auto">
                
                <!-- Page Header -->
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Paramètres du Profil</h1>
                        <p class="text-slate-500 text-sm mt-1">Gérez vos informations personnelles et la sécurité.</p>
                    </div>
                    
                    @if(Auth::user()->role === 'admin')
                        <span class="px-4 py-1.5 bg-blue-50 text-blue-600 border border-blue-100 rounded-full text-[10px] font-black uppercase tracking-widest">
                            Mode Admin
                        </span>
                    @endif
                </div>

                <div class="space-y-8">
                    <!-- Section 1: Infos -->
                    <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                        <div class="max-w-xl">
                            <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-6 border-l-4 border-blue-600 pl-3">Informations Publiques</h3>
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Section 2: Password -->
                    <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                        <div class="max-w-xl">
                            <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-6 border-l-4 border-slate-400 pl-3">Sécurité du Compte</h3>
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Section 3: Delete (User Only) -->
                    @if(Auth::user()->role !== 'admin')
                    <div class="bg-red-50/50 p-8 rounded-2xl border border-red-100 shadow-sm">
                        <div class="max-w-xl">
                            <h3 class="text-sm font-black text-red-800 uppercase tracking-wider mb-6">Zone de Danger</h3>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </main>

    </div>

</body>
</html>