<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50">

    <div class="flex min-h-screen">
        <!-- SIDEBAR -->
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
            <div class="max-w-7xl mx-auto">
                
                <!-- Header -->
                <div class="flex justify-between items-center mb-10 border-b border-gray-200 pb-6">
                    <div>
                        <h1 class="text-3xl font-black text-slate-900 uppercase tracking-tight">Catalogue</h1>
                        <p class="text-slate-500 text-sm font-medium mt-1">{{ $livres->count() }} livres disponibles</p>
                    </div>
                    @if($hasActiveSub)
                        <div class="bg-blue-600 text-white px-4 py-2 rounded text-[10px] font-bold uppercase tracking-widest">
                            Membre VIP
                        </div>
                    @endif
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($livres as $livre)
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                            
                            <!-- Image Section (No Shadow/No Hover scale) -->
                            <div class="aspect-[3/4] bg-gray-100 border-b border-gray-100">
                                <img src="{{ $livre->image ? asset('storage/'.$livre->image) : 'https://via.placeholder.com/300x400' }}" 
                                     class="w-full h-full object-cover"
                                     alt="{{ $livre->titre }}">
                            </div>

                            <!-- Text Info -->
                            <div class="p-4 text-center">
                                <h3 class="font-bold text-slate-900 text-sm uppercase truncate">
                                    {{ $livre->titre }}
                                </h3>
                                <p class="text-blue-600 text-[10px] font-bold mt-1 uppercase tracking-widest">
                                    {{ $livre->auteur->nom ?? 'Auteur Inconnu' }}
                                </p>
                            </div>

                            <!-- Buttons Section (Simple Colors) -->
                            <div class="p-4 pt-0 space-y-2">
                                <form action="{{ route('emprunts.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                    <button class="w-full bg-blue-600 text-white py-3 rounded font-bold text-[10px] uppercase tracking-widest flex justify-between px-4">
                                        <span>Réserver</span>
                                        <span>{{ number_format($livre->prix_final, 2) }} DH</span>
                                    </button>
                                </form>

                                <form action="{{route('achats.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                    <button class="w-full bg-slate-900 text-white py-3 rounded font-bold text-[10px] uppercase tracking-widest flex justify-between px-4">
                                        <span class="text-slate-400">Acheter</span>
                                        <span class="text-blue-400">{{ number_format($livre->prix_achat, 2) }} DH</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center border-2 border-dashed border-gray-200 rounded-xl">
                            <p class="text-slate-400 font-bold uppercase text-xs tracking-widest">Aucun livre trouvé</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </main>
    </div>

</body>
</html>