<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunter un Livre | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#f8fafc]">

    <div class="flex min-h-screen">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col sticky top-0 h-screen">
            <div class="p-8 text-center">
                <h2 class="text-2xl font-black text-blue-400 tracking-tighter italic">BiblioTech</h2>
            </div>

            <nav class="flex-1 px-4 space-y-2 mt-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-gray-400 hover:bg-slate-800 hover:text-white transition font-medium">
                    <span>🏠</span> Accueil
                </a>
                <a href="{{ route('livres.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-gray-400 hover:bg-slate-800 hover:text-white transition font-medium">
                    <span>📚</span> Catalogue
                </a>
                <div class="h-[1px] bg-slate-800 my-4 mx-4"></div>
                <a href="{{ route('emprunts.mes_emprunts') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-gray-400 hover:bg-slate-800 hover:text-white transition font-medium">
                    <span>📖</span> Mes Emprunts
                </a>
            </nav>

            <div class="p-6 border-t border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full flex items-center gap-3 text-red-400 font-bold hover:bg-red-950/30 p-3 rounded-xl transition">
                        <span>🚪</span> Quitter
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-4 md:p-10">
            <div class="max-w-3xl mx-auto">
                
                <!-- Back Button -->
                <a href="{{ route('livres.index') }}" class="text-slate-400 hover:text-slate-900 font-bold text-sm flex items-center gap-2 mb-6 transition">
                    <span>←</span> Retour au catalogue
                </a>

                <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                    <div class="mb-8 text-center">
                        <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-[2rem] flex items-center justify-center text-4xl mx-auto mb-4">📖</div>
                        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Nouvel Emprunt</h1>
                        <p class="text-slate-500 font-medium mt-2 text-sm italic">Choisissez votre prochain compagnon de route.</p>
                    </div>

                    @if(session('success'))
                        <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 p-4 rounded-2xl mb-6 text-sm font-bold flex items-center gap-3">
                            <span>✅</span> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('emprunts.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Livre Selection -->
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3 ml-2">Sélectionner le livre</label>
                            <div class="relative">
                                <select name="livre_id" class="w-full bg-slate-50 border-2 border-slate-100 text-slate-900 text-sm font-bold rounded-2xl p-4 appearance-none focus:outline-none focus:border-blue-500 transition cursor-pointer">
                                    <option value="" disabled selected>— Choisir un titre —</option>
                                    @foreach($livres as $livre)
                                        <option value="{{ $livre->id }}">
                                            {{ $livre->titre }} ({{ $livre->prix }} DH)
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 font-bold">↓</div>
                            </div>
                        </div>

                        <!-- Info Card (Smart Logic Promo) -->
                        <div class="p-6 bg-slate-900 rounded-[2rem] text-white relative overflow-hidden">
                            <div class="relative z-10 flex items-center justify-between">
                                <div>
                                    <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-1">Avantage Membre</p>
                                    <p class="text-xs text-slate-300 font-medium">Si vous avez un abonnement actif, <br> vous bénéficiez de <span class="text-white font-black italic">-50%</span> sur le prix.</p>
                                </div>
                                <div class="text-3xl">✨</div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-5 rounded-2xl shadow-lg shadow-blue-600/30 transition transform hover:-translate-y-1 active:scale-95 text-xs uppercase tracking-widest">
                            Confirmer la Réservation
                        </button>
                    </form>

                    <p class="text-center text-slate-400 text-[10px] font-bold mt-8 uppercase tracking-tighter">
                        * Le paiement et le retrait se font sur place à la bibliothèque.
                    </p>
                </div>
            </div>
        </main>
    </div>

</body>
</html>