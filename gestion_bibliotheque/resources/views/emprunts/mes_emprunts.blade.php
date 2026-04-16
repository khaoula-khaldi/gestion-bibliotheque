<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Emprunts | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>

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
            <div class="max-w-5xl mx-auto">

                <div class="mb-12 text-center md:text-left">
                    <h1 class="text-2xl font-bold text-slate-900">Mes Lectures</h1>
                    <p class="text-slate-500 text-sm mt-1">Suivez l'état de vos emprunts en cours et passés.</p>
                </div>

                <!-- Liste des Emprunts -->
                <div class="space-y-4">
                    @forelse($emprunts as $emprunt)
                        <div class="bg-white border-gray-100 p-5 ">
                            <div>
                                    <h3 class="font-bold text-slate-900">{{ $emprunt->livre->titre }}</h3>
                        
                            </div>
  
                            <div class="mt-4 md:mt-0 flex items-center justify-between md:justify-end gap-6">
                                <div class="text-right">
                                    @if($emprunt->statut == 'en_cours')
                                        <span class="px-3 py-1 text-amber-600 text-[11px] font-bold rounded-full   border">
                                            À rendre
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-green-50 text-green-600 text-[11px] font-bold rounded-full border">
                                            Rendu
                                        </span>

                                    @endif
                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="py-20 text-center">
                            <h2 class="text-lg font-bold text-slate-900">Aucun emprunt pour le moment</h2>
                            <p class="text-slate-500 text-sm mb-6">Vous n'avez pas encore emprunté de livres.</p>
                            <a href="{{ route('livres.catalogue') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-bold text-xs  ">
                                Parcourir le catalogue
                            </a>
                        </div>
                    @endforelse
                </div>

            </div>
        </main>
    </div>
</body>
</html>