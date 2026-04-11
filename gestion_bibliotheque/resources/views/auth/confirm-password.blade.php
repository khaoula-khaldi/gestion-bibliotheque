<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié | Votre Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-gray-950 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-[440px]">
        
        <!-- Bouton Retour -->
        <a href="{{ route('login') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-indigo-600 mb-8 transition-colors group font-medium">
            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour à la connexion
        </a>

        <!-- Carte Principale -->
        <div class="bg-white dark:bg-gray-900 rounded-[2.5rem] shadow-xl shadow-indigo-100/50 dark:shadow-none p-8 md:p-10 border border-gray-100 dark:border-gray-800">
            
            <!-- Icône & En-tête -->
            <div class="mb-8">
                <div class="w-14 h-14 bg-amber-50 dark:bg-amber-900/20 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">
                    Mot de passe oublié ?
                </h1>
                <p class="text-gray-500 dark:text-gray-400 mt-3 text-sm leading-relaxed">
                    {{ __("Pas de problème. Indiquez-nous votre adresse e-mail et nous vous enverrons un lien de réinitialisation pour en choisir un nouveau.") }}
                </p>
            </div>

            <!-- État de la Session (Message de Succès) -->
            @if (session('status'))
                <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-100 dark:border-emerald-800 rounded-2xl">
                    <p class="text-sm text-emerald-700 dark:text-emerald-400 font-medium flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ session('status') }}
                    </p>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Adresse E-mail -->
                <div class="space-y-2">
                    <label for="email" class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">
                        {{ __('Adresse E-mail') }}
                    </label>
                    <div class="relative group">
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus
                               placeholder="votre@email.com"
                               class="w-full px-5 py-4 bg-gray-50 dark:bg-gray-800/50 border-2 border-transparent rounded-2xl focus:border-indigo-500 focus:bg-white dark:focus:bg-gray-800 outline-none transition-all duration-200 text-gray-900 dark:text-white placeholder:text-gray-400"
                        >
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-300 group-focus-within:text-indigo-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                            </svg>
                        </div>
                    </div>
                    @if($errors->has('email'))
                        <p class="text-red-500 text-xs mt-1 font-medium ml-1 italic">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>

                <!-- Bouton d'envoi -->
                <button type="submit" 
                        class="w-full bg-gray-900 dark:bg-indigo-600 hover:bg-black dark:hover:bg-indigo-700 text-white font-bold py-4 rounded-2xl shadow-xl transition-all duration-300 transform active:scale-[0.98] flex items-center justify-center space-x-3">
                    <span>{{ __('Envoyer le lien') }}</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>
        </div>

        <!-- Texte d'aide -->
        <p class="text-center mt-8 text-sm text-gray-500">
            Encore des difficultés ? <a href="#" class="text-indigo-600 font-semibold hover:underline">Contactez le support</a>
        </p>
    </div>

</body>
</html>