<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-slate-900">

    <nav class="border-b border-slate-100 px-6 py-4 flex justify-between items-center">
        <span class="text-lg font-bold text-blue-600">BiblioTech</span>
        <div class="flex gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm font-semibold">Mon Espace</a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-semibold">Connexion</a>
                <a href="{{ route('register') }}" class="text-sm font-semibold bg-slate-900 text-white px-4 py-2 rounded">S'inscrire</a>
            @endauth
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-20 text-center">
        <h1 class="text-4xl md:text-6xl font-black mb-6">Gestion de bibliothèque. <br> Simple et Rapide.</h1>
        <p class="text-lg text-slate-500 mb-10">Une interface épurée pour gérer vos ouvrages et vos membres sans distraction.</p>
        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-3 rounded font-bold">Commencer maintenant</a>
    </main>

    <section class="max-w-4xl mx-auto px-6 py-12 border-t border-slate-100 grid md:grid-cols-3 gap-8">
        <div>
            <h3 class="font-bold text-blue-600 mb-2 underline">01. Inventaire</h3>
            <p class="text-sm">Gérez vos livres et stocks en quelques clics.</p>
        </div>
        <div>
            <h3 class="font-bold text-blue-600 mb-2 underline">02. Membres</h3>
            <p class="text-sm">Suivez les emprunteurs et leurs abonnements.</p>
        </div>
        <div>
            <h3 class="font-bold text-blue-600 mb-2 underline">03. Retours</h3>
            <p class="text-sm">Contrôlez les dates et les retards facilement.</p>
        </div>
    </section>

    <footer class="text-center py-10 text-slate-400 text-xs uppercase tracking-widest">
        &copy; 2026 BiblioTech — Projet PFA
    </footer>

</body>
</html>