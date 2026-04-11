<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Achats | BiblioTech</title>
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

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 md:p-12">
            <div class="max-w-4xl mx-auto">
                
                <!-- Header Simple -->
                <div class="mb-10 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Mes Livres Achetés</h1>
                        <p class="text-slate-500 text-sm mt-1">L'historique complet de vos achats.</p>
                    </div>
                    <div class="bg-white px-4 py-2 rounded-lg border border-gray-200 shadow-sm">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block leading-none">Total</span>
                        <span class="text-xl font-black text-blue-600">{{ $achats->count() }}</span>
                    </div>
                </div>

                <!-- List des achats -->
                <div class="grid gap-4">
                    @forelse($achats as $achat)
                        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center justify-between hover:border-blue-300 transition-colors shadow-sm">
                            
                            <!-- Info Livre -->
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800">{{ $achat->livre->titre }}</h3>
                                    <p class="text-[11px] text-slate-400 uppercase font-bold tracking-tight">Payé le {{ $achat->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>

                            <!-- Prix & Badge -->
                            <div class="text-right">
                                <span class="block text-lg font-black text-slate-900">{{ number_format($achat->prix, 2) }} DH</span>
                                <span class="inline-block px-2 py-0.5 bg-green-100 text-green-700 text-[10px] font-bold rounded uppercase">Confirmé</span>
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