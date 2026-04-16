<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioTech | Minimal</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-white text-slate-900 antialiased">

    <nav class="border-b px-6 py-4">
        <div class=" flex justify-between items-center">
            <span class="text-lg font-bold ">BiblioTech</span>
            
            <div class="flex gap-6 items-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-xs font-bold ">Mon Espace</a>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-bold ">Connexion</a>
                    <a href="{{ route('register') }}" class="text-xs font-bold  border-2 px-3 py-1">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-20">
        <div class="max-w-2xl">
            <h1 class="text-5xl font-black mb-6 ">
                Gestion de bibliothèque. <br>
                Simple. Rapide.
            </h1>
            <p class="text-lg mb-10 ">
                Une interface épurée pour gérer vos ouvrages, vos membres et vos emprunts sans aucune distraction.
            </p>
            <a href="{{ route('register') }}" class="inline-block bg-slate-900 text-white px-8 py-4 font-bold  text-xs ">
                Commencer maintenant
            </a>
        </div>
    </main>

    <section class="max-w-5xl mx-auto px-6 ">
        <div class="grid md:grid-cols-3 gap-12">
            <div>
                <h3 class="font-bold mb-3 text-blue-600">01. Inventaire</h3>
                <p class="text-smtext-black">Ajoutez et modifiez vos livres dans une base de données simplifiée.</p>
            </div>
            <div>
                <h3 class="font-bold mb-3 text-blue-600">02. Membres</h3>
                <p class="text-smtext-black">Gérez les profils et les autorisations d'emprunt facilement.</p>
            </div>
            <div>
                <h3 class="font-bold mb-3 text-blue-600">03. Retours</h3>
                <p class="text-smtext-black">Suivez les dates d'échéance et recevez des alertes automatiques.</p>
            </div>
        </div>
    </section>

    <footer class="max-w-5xl mx-auto px-6 py-12 ">
        <p class="text-black text-[10px] font-bold">
            &copy; 2026 BiblioTech — Projet Open Source
        </p>
    </footer>

</body>
</html>