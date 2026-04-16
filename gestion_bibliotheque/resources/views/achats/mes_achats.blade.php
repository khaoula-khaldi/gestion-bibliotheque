<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Achats | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50">
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

   
        <main class="flex-1 p-6 md:p-12">
            <div class="max-w-4xl mx-auto">

                <div class="mb-10 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-black">Mes Livres Achetés</h1>
                        <p class="text-slate-500 text-sm mt-1">L'historique complet de vos achats.</p>
                    </div>
                    <div class="bg-white px-4 py-2 rborder border-gray-200 shadow-sm">
                        <span class="text-[10px] font-bold text-slate-400">Total</span>
                        <span class="text-xl font-black text-blue-600">{{ $achats->count() }}</span>
                    </div>
                </div>

                <div class="grid gap-4">
                    @forelse($achats as $achat)
                        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center justify-between ">

                            <div class="flex items-center gap-4">
                                
                                    <h3 class="font-bold text-slate-800">{{ $achat->livre->titre }}</h3>
                                    <p class="text-[11px] text-slate-400  font-bold ">Payé le {{ $achat->created_at->format('d/m/Y') }}</p>
                           
                            </div>

                            <div class="text-right">
                                <span class="block text-lg font-black text-slate-900">{{ number_format($achat->prix, 2) }} DH</span>
                                <span class="px-2 py-0.5 bg-green-100 t text-[10px] font-bold rounded ">Confirmé</span>
                            </div>
                        </div>
                    @empty
                        <!-- Centralized Empty State -->
                        <div class="py-20 text-center bg-white rounded-2xl border-2 border-dashed border-gray-200">
                            <p class="text-gray-400 font-medium mb-4">Vous n'avez encore rien acheté.</p>
                            <a href="{{ route('livres.catalogue') }}" class="text-blue-600 font-bold hover:underline text-sm uppercase">Découvrir le catalogue</a>
                        </div>
                    @endforelse
                </div>

            </div>
        </main>
    </div>
</body>
</html>