<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-white">
     <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-900 text-white  md:flex flex-col  ">
            <div class="p-8 text-center border-b border-slate-800">
                <h2 class="text-xl font-bold text-blue-400  tracking-wider">BiblioTech</h2>
            </div>
            <nav class="flex-1 px-4 space-y-1 mt-6">
                <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-lg bg-slate-800 text-white  text-xs ">
                    Accueil
                </a>
                <a href="{{ route('livres.catalogue') }}" class="block px-4 py-3 text-slate-400 hover:text-white  text-xs ">
                    Catalogue
                </a>
                
                <div class="h-[1px] bg-slate-800 my-4 mx-4"></div>

                @if(auth()->user()->role == 'admin')
                    <a href="{{ route('emprunts.index') }}" class="block px-4 py-3 text-slate-400 hover:text-white  text-xs ">Gestion Emprunts</a>
                @else
                    <a href="{{ route('emprunts.mes_emprunts') }}" class="block px-4 py-3 text-slate-400 hover:text-white  text-xs ">Mes Emprunts</a>
                @endif

                <a href="{{ route('achats.mes_achats') }}" class="block px-4 py-3 text-slate-400 hover:text-white  text-xs ">Mes Achats</a>
                <a href="/profile" class="block px-4 py-3 text-slate-400 hover:text-white  text-xs ">Mon Profil</a>
            </nav>
            <div class="p-4 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left p-3 text-red-400 text-xs  ">Déconnexion</button>
                </form>
            </div>
        </aside>


        <main class="flex-1 p-8">
            <div class="max-w-5xl mx-auto">
                
                <div class="mb-12 border-b border-slate-100 pb-8">
                    <h1 class="text-2xl font-bold text-slate-900">Bonjour, {{  auth()->user()->name }}</h1>
                    <p class="text-slate-500 text-sm mt-1">Tableau de bord BiblioTech.</p>
                </div>

                    <div class="mt-8">
                        @if(!$hasActiveSub)
                            <a href="{{ route('subscriptions.create') }}" class="border border-slate-900 px-6 py-2 text-[10px] font-black">
                                S'abonner (0 Dh)
                            </a>
                        @else
                            <span class="text-[10px] font-black  text-emerald-600">Abonnement Actif</span>
                        @endif
                    </div>
                    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-12">


                    <div class="border border-slate-200 p-6 text-center">
                        <p class="text-[10px] font-bold  text-slate-400 mb-1">Emprunts</p>
                        <h3 class="text-2xl font-semibolde text-slate-900">{{ $emprunts->count() }}</h3>
                    </div>
                    <div class="border border-slate-200 p-6 text-center">
                        <p class="text-[10px] font-bold  text-slate-400 mb-1">Achats</p>
                        <h3 class="text-2xl font-semibolde text-slate-900">{{ $achats->count() }}</h3>
                    </div>
                </div>

                <section class="mb-12">
                    <h2 class="text-xs font-black  text-black mb-4 border-slate-900 pl-3">Derniers Emprunts</h2>
                    <div class="">
                        @forelse($emprunts->take(3) as $emprunt)
                            <div class="py-4 flex justify-between items-center">
                                <span class="text-sm  text-slate-700">{{ $emprunt->livre->titre }}</span>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 py-4 ">Aucune activité.</p>
                        @endforelse
                    </div>
                </section>



            </div>
        </main>
    </div>
</body>
</html>