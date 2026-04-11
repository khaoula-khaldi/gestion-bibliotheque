<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié | Votre Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-gray-950 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-[450px]">
        
        <!-- Bouton Retour -->
        <div class="mb-8">
            <a href="{{ route('login') }}" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-colors group">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour à la connexion
            </a>
        </div>

        <!-- Carte Principale -->
        <div class="bg-white dark:bg-gray-900 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] dark:shadow-none p-8 md:p-10 border border-gray-100 dark:border-gray-800">
            
            <!-- Header Icon & Text -->
            <div class="mb-8">
                <div class="w-14 h-14 bg-amber-50 dark:bg-amber-900/20 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight">Mot de passe oublié ?</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-3 text-sm leading-relaxed">
                    {{ __('Pas de problème. Indiquez-nous votre adresse e-mail et nous vous enverrons un lien de réinitialisation pour en choisir un nouveau.') }}
                </p>
            </div>

            <!-- Session Status (Message de succès) -->
            @if (session('status'))
                <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-100 dark:border-emerald-800 rounded-2xl text-sm font-medium text-emerald-700 dark:text-emerald-400 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="text-xs font-bold text-gray-400 uppercase tracking-[0.1em] ml-1">Adresse E-mail</label>
                    <div class="relative group">
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               placeholder="votre@exemple.com"
                               class="w-full px-5 py-4 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all duration-200 text-gray-900 dark:text-white placeholder:text-gray-400"
                        >
                    </div>
                    @if($errors->has('email'))
                        <p class="text-red-500 text-xs mt-1 ml-1 font-medium italic">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-200 dark:shadow-none transition-all duration-300 transform active:scale-[0.98] flex items-center justify-center">
                    {{ __('Envoyer le lien') }}
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>
        </div>

        <!-- Footer Help -->
        <p class="text-center mt-10 text-sm text-gray-500">
            Besoin d'aide supplémentaire ? <a href="#" class="text-indigo-600 font-bold hover:underline">Contactez le support</a>
        </p>
    </div>

</body>
</html>