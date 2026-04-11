<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioTech | Simple & Clean</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Typography simple bach t-kon l-qraya sahla */
        body { font-family: system-ui, -apple-system, sans-serif; }
    </style>
</head>
<body class="bg-white text-slate-800">

    <!-- 1. NAVBAR (Ghir b-khat mn l-taht) -->
    <nav class="border-b border-slate-200 px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="text-blue-600">
                <i data-lucide="book-open" class="w-6 h-6"></i>
            </div>
            <span class="text-lg font-bold tracking-tight">BiblioTech</span>
        </div>

        <div class="flex items-center gap-5">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-blue-600">Mon Compte</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium hover:text-blue-600">Connexion</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm font-bold hover:bg-blue-700 transition">
                            S'inscrire
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- 2. HERO SECTION (Fassala simple: Text f l-issar u Icons f l-imin) -->
    <main class="max-w-6xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-center">
        
        <div class="space-y-6">
            <h1 class="text-4xl md:text-5xl font-black text-slate-900">
                Gérez vos livres <br> 
                <span class="text-blue-600 italic">sans prise de tête.</span>
            </h1>
            <p class="text-lg text-slate-500 leading-relaxed">
                Un outil simple pour les bibliothèques. Ajoutez des livres, gérez les membres et suivez les retours en quelques clics.
            </p>
            <div class="flex gap-4">
                <a href="{{ route('register') }}" class="border-2 border-slate-900 bg-slate-900 text-white px-6 py-3 rounded font-bold hover:bg-white hover:text-slate-900 transition">
                    Créer mon catalogue
                </a>
            </div>
        </div>

        
        <div class="rounded-2xl p-8 flex flex-col gap-4">

        </div>
    </main>

    <!-- 3. FEATURES (Grid simple) -->
    <section class="border-t border-slate-100 py-16">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-8">
            
            <div class="p-6 border border-slate-100 rounded-xl">
                <i data-lucide="plus-circle" class="text-blue-600 mb-3"></i>
                <h3 class="font-bold text-lg mb-1">Ajout Rapide</h3>
                <p class="text-sm text-slate-500 italic">Scannez ou entrez les infos du livre manuellement.</p>
            </div>

            <div class="p-6 border border-slate-100 rounded-xl">
                <i data-lucide="users" class="text-blue-600 mb-3"></i>
                <h3 class="font-bold text-lg mb-1">Membres</h3>
                <p class="text-sm text-slate-500 italic">Gardez un oeil sur qui a emprunté quoi.</p>
            </div>

            <div class="p-6 border border-slate-100 rounded-xl">
                <i data-lucide="calendar" class="text-blue-600 mb-3"></i>
                <h3 class="font-bold text-lg mb-1">Délais</h3>
                <p class="text-sm text-slate-500 italic">Recevez des alertes pour les livres non rendus.</p>
            </div>

        </div>
    </section>

    <!-- 4. FOOTER -->
    <footer class="py-10 text-center border-t border-slate-50">
        <p class="text-slate-400 text-xs tracking-widest uppercase">
            &copy; 2026 BiblioTech — Apprendre par la pratique.
        </p>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>