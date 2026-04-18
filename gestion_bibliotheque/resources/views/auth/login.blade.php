<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-[#fafafa] text-slate-900 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-[400px]">
        
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-slate-900">BiblioTech</h2>
            <p class="text-slate-500 text-sm mt-2">Bon retour parmi nous.</p>
        </div>

        @if (session('status'))
            <div class="mb-6 p-3 bg-blue-50 border border-blue-100 text-xs  text-blue-600 text-center ">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white border border-slate-200 p-8 ">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="email" class="block text-[11px]   text-slate-500">Adresse E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                           placeholder="nom@exemple.com"
                           class="w-full px-4 py-2.5 bg-white border border-slate-300text-sm">
                    @if($errors->has('email'))
                        <p class="text-red-500 text-[10px] font-semibold mt-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label for="password" class="block text-[11px]   text-slate-500">Mot de passe</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[10px] text-blue-600  ">Oublié ?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required 
                           placeholder="••••••••"
                           class="w-full px-4 py-2.5 bg-white border border-slate-300text-sm">
                    @if($errors->has('password'))
                        <p class="text-red-500 text-[10px] font-semibold mt-1">{{ $errors->first('password') }}</p>
                    @endif
                </div>


                <button type="submit" class="w-full bg-slate-900 text-white font-semibold py-3 text-sm">
                    Se connecter
                </button>
            </form>
        </div>

        <p class="text-center mt-8 text-sm text-slate-500">
            Pas encore de compte ? 
            <a href="{{ route('register') }}" class="text-blue-600  ">S'inscrire gratuitement</a>
        </p>

    </div>

</body>
</html>