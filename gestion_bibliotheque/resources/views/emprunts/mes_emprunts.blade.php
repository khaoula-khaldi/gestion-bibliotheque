<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Emprunts | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- SIDEBAR (Inchangée) -->
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

        <!-- MAIN CONTENT (Plus simple) -->
        <main class="flex-1 p-6 md:p-12">
            <div class="max-w-5xl mx-auto">
                
                <!-- Header -->
                <div class="mb-12 text-center md:text-left">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Mes Lectures</h1>
                    <p class="text-slate-500 text-sm mt-1">Suivez l'état de vos emprunts en cours et passés.</p>
                </div>

                <!-- Liste des Emprunts -->
                <div class="space-y-4">
                    @forelse($emprunts as $emprunt)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col md:flex-row md:items-center justify-between hover:shadow-md transition-shadow">
                            
                            <!-- Info Livre -->
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900">{{ $emprunt->livre->titre }}</h3>
                                    <p class="text-xs text-slate-400 font-medium">Prix payé : {{ number_format($emprunt->prix, 2) }} DH</p>
                                </div>
                            </div>

                            <!-- Statut & Action -->
                            <div class="mt-4 md:mt-0 flex items-center justify-between md:justify-end gap-6">
                                <div class="text-right">
                                    @if($emprunt->statut == 'en_cours')
                                        <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[11px] font-bold rounded-full uppercase tracking-wider border border-amber-100">
                                            À rendre
                                        </span>
                                        <p class="text-[10px] text-slate-400 mt-1 italic">Veuillez le ramener</p>
                                    @else
                                        <span class="px-3 py-1 bg-green-50 text-green-600 text-[11px] font-bold rounded-full uppercase tracking-wider border border-green-100">
                                            Rendu
                                        </span>
                                        <p class="text-[10px] text-slate-400 mt-1">
                                            Le {{ \Carbon\Carbon::parse($emprunt->date_retour)->format('d/m/Y') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    @empty
                        <!-- État vide -->
                        <div class="py-20 text-center">
                            <div class="bg-gray-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-slate-900">Aucun emprunt pour le moment</h2>
                            <p class="text-slate-500 text-sm mb-6">Vous n'avez pas encore emprunté de livres.</p>
                            <a href="{{ route('livres.catalogue') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-bold text-xs uppercase tracking-widest hover:bg-blue-700 transition">
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