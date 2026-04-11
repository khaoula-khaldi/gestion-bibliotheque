<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-[450px]">
        
        <!-- Header simple -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-slate-900">Rejoindre BiblioTech</h1>
            <p class="text-slate-500 text-sm mt-1">Créez votre compte en moins d'une minute.</p>
        </div>

        <!-- Card principal -->
        <div class="bg-white border border-slate-200 rounded-xl p-8">
            
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Nom Complet -->
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2 ml-1">Nom complet</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus 
                           placeholder="Ex: Ahmed Alami"
                           class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg focus:border-blue-600 outline-none transition-all text-sm">
                    @if($errors->has('name'))
                        <p class="text-red-500 text-xs mt-1 italic">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2 ml-1">Adresse E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                           placeholder="nom@exemple.com"
                           class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg focus:border-blue-600 outline-none transition-all text-sm">
                    @if($errors->has('email'))
                        <p class="text-red-500 text-xs mt-1 italic">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Password Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2 ml-1">Mot de passe</label>
                        <input id="password" type="password" name="password" required 
                               placeholder="••••••••"
                               class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg focus:border-blue-600 outline-none transition-all text-sm">
                    </div>

                    <!-- Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2 ml-1">Confirmation</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required 
                               placeholder="••••••••"
                               class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg focus:border-blue-600 outline-none transition-all text-sm">
                    </div>
                </div>
                @if($errors->has('password'))
                    <p class="text-red-500 text-xs mt-1 italic ml-1">{{ $errors->first('password') }}</p>
                @endif

                <!-- Bouton S'inscrire -->
                <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3.5 rounded-lg hover:bg-blue-600 transition shadow-sm mt-2">
                    S'inscrire maintenant
                </button>
            </form>

            <!-- Retour au Login -->
            <div class="mt-8 text-center border-t border-slate-100 pt-6">
                <p class="text-sm text-slate-500">
                    Déjà membre ? 
                    <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline ml-1">Se connecter</a>
                </p>
            </div>
        </div>

        <!-- Footer Footer -->
        <p class="text-center mt-10 text-slate-400 text-[10px] uppercase tracking-widest">
            &copy; {{ date('Y') }} BiblioTech &bull; Inscription Gratuite
        </p>
    </div>

</body>
</html>