<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-200">
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
     
        <main class="flex-1 p-6 md:p-10">
            <div class="max-w-7xl mx-auto">
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 border-b border-gray-200 pb-8 gap-6">
                    <div>
                        <h1 class="text-3xl font-black text-slate-900 ">Catalogue</h1>
                        <p class="text-slate-500 text-sm font-medium mt-1">{{ $livres->count() }} livres disponibles</p>
                    </div>

                    <div class="w-full md:w-1/2">
                        <form action="{{ route('livres.catalogue') }}" method="GET" class="flex items-center">
                            <div class="relative flex-1">
                                <input type="text" name="keyword" value="{{ request('keyword') }}"
                                    placeholder="Chercher un titre, ISBN ou auteur..." 
                                    class="w-full bg-white border border-gray-200 py-3.5 pl-12 pr-4 rounded-xl text-sm ">
                            </div>

                            <button type="submit" class="ml-2 bg-black text-white px-5 py-3.5 rounded-xl text-[10px] font-bold">
                                Chercher
                            </button>
                        </form>
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
                        
                    </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($livres as $livre)
                        <div class="bg-white border border-gray-200 rounded-xl">
                            
                            <div class="bg-gray-100 border-b border-gray-100 ">
                                <img src="{{ $livre->image ? asset('storage/'.$livre->image) : 'https://via.placeholder.com/300x400' }}" 
                                     class="w-full h-full "
                                     alt="{{ $livre->titre }}">
                            </div>

                            <div class="p-4 text-center">
                                <h3 class="font-bold textblack text-sm  px-2">
                                    {{ $livre->titre }}
                                </h3>
                                <p class="text-blue-600 text-[10px] font-bold mt-1">
                                    {{ $livre->auteur->nom ?? 'Auteur Inconnu' }}
                                </p>
                            </div>

                            @if(session('error'))
                                <div class="max-w-md mx-auto mt-4">
                                    <div class="bg-white border-l-4 border-red-500 shadow-md rounded-r-lg p-4 flex items-center gap-3">
                                        <div>
                                            <p class="text-xs font-black text-gray-400">Attention</p>
                                            <p class="text-sm font-bold text-gray-800">
                                                {{ session('error') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="p-4 pt-0 space-y-2">
                                <form action="{{ route('emprunts.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                    <button class="w-full bg-blue-600 text-white py-3 rounded font-bold text-[10px] flex justify-between px-4 ">
                                        <span>Réserver</span>
                                        <span>{{ number_format($livre->prix_final, 2) }} DH</span>
                                    </button>
                                </form>

                                <form action="{{route('achats.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                    <button class="w-full bg-black text-white py-3 rounded font-bold text-[10px] flex justify-between px-4 ">
                                        <span class="text-slate-400">Acheter</span>
                                        <span class="text-blue-400">{{ number_format($livre->prix_achat, 2) }} DH</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center border-2  border-gray-200 rounded-xl bg-white">
                            <p class="text-slate-400 text-xs ">Aucun livre trouvé</p>
                            @if(request('keyword'))
                                <a href="{{ route('livres.catalogue') }}" class="text-blue-600 text-xs mt-2 inline-block ">Voir tout le catalogue</a>
                            @endif
                        </div>
                    @endforelse
                </div>

            </div>
        </main>
    </div>

</body>
</html>