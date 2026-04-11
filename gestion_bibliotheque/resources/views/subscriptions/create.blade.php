<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnement | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 border border-gray-200 w-full max-w-md">
        
        <h1 class="text-xl font-bold mb-6 text-gray-800">S'abonner</h1>

        <form action="{{ route('subscriptions.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <!-- Select simple -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Choisir un forfait</label>
                <select name="type" id="type" class="w-full p-3 border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-black focus:border-black outline-none transition-all">
                    <option value="mensuel">Mensuel — 9.99 € / mois</option>
                    <option value="annuel">Annuel — 89.99 € / an</option>
                </select>
            </div>

            <!-- Info user simple -->
            <p class="text-xs text-gray-400">
                Compte : <span class="font-medium text-gray-600">{{ $user->name }}</span>
            </p>

            <!-- Bouton simple -->
            <button type="submit" class="w-full bg-black text-white py-3 font-semibold hover:bg-gray-800 transition">
                Confirmer
            </button>

            <!-- Retour -->
            <div class="text-center">
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-400 hover:text-black">Annuler</a>
            </div>
        </form>

    </div>

</body>
</html>