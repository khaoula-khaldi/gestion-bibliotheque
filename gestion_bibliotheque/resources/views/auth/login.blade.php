<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-[400px]">
        
        <!-- Logo u Titre -->
        <div class="text-center mb-8">

            <h1 class="text-2xl font-bold text-slate-900">Bon retour !</h1>
            <p class="text-slate-500 text-sm">Entrez vos accès pour continuer</p>
        </div>

        <!-- Status de session (Messages de succès) -->
        @if (session('status'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded text-sm text-green-700 text-center">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulaire -->
        <div class="bg-white border border-slate-200 rounded-xl p-8">
            
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2 ml-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                           placeholder="nom@exemple.com"
                           class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg focus:border-blue-600 outline-none transition-all text-sm">
                    @if($errors->has('email'))
                        <p class="text-red-500 text-xs mt-1 italic">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div>
                    <div class="flex justify-between items-center mb-2 ml-1">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-500">Mot de passe</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-blue-600 hover:underline">Oublié ?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required 
                           placeholder="••••••••"
                           class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg focus:border-blue-600 outline-none transition-all text-sm">
                    @if($errors->has('password'))
                        <p class="text-red-500 text-xs mt-1 italic">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                @if (session('error'))
                    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #f5c6cb;">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Remember Me -->
                <div class="flex items-center gap-2 ml-1">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600 focus:ring-0">
                    <label for="remember_me" class="text-sm text-slate-600 cursor-pointer">Rester connecté</label>
                </div>

                <!-- Bouton Submit -->
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition shadow-sm">
                    Se connecter
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                <p class="text-sm text-slate-500 mb-3">Pas encore de compte ?</p>
                <a href="{{ route('register') }}" class="text-sm font-bold text-slate-900 hover:text-blue-600">
                    Créer un compte gratuitement
                </a>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center mt-8 text-slate-400 text-[10px] tracking-[0.2em] uppercase">
            &copy; {{ date('Y') }} BiblioTech &bull; Sécurisé
        </p>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>