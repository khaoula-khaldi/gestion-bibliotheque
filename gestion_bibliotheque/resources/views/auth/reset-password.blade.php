<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe | Votre App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-gray-950 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-[460px]">
        
        <!-- Logo / Icon -->
        <div class="flex justify-center mb-8">
            <div class="p-4 bg-indigo-600 rounded-2xl shadow-lg rotate-3">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
        </div>

        <!-- Main Card -->
        <div class="bg-white dark:bg-gray-900 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.03)] dark:shadow-none p-8 md:p-10 border border-gray-100 dark:border-gray-800">
            
            <div class="text-center mb-10">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Nouveau mot de passe</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm leading-relaxed">
                    Veuillez choisir un mot de passe fort pour sécuriser votre compte.
                </p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address (Souvent Read-only ou pré-rempli) -->
                <div class="space-y-2">
                    <label for="email" class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Adresse e-mail</label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email', $request->email) }}" 
                           required 
                           autofocus
                           class="w-full px-5 py-4 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all duration-200 dark:text-white"
                    >
                    @if($errors->has('email'))
                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Nouveau mot de passe</label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           placeholder="••••••••"
                           class="w-full px-5 py-4 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all duration-200 dark:text-white"
                    >
                    @if($errors->has('password'))
                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Confirmer le mot de passe</label>
                    <input id="password_confirmation" 
                           type="password" 
                           name="password_confirmation" 
                           required 
                           placeholder="••••••••"
                           class="w-full px-5 py-4 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all duration-200 dark:text-white"
                    >
                    @if($errors->has('password_confirmation'))
                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-100 dark:shadow-none transition-all duration-300 transform active:scale-[0.98]">
                        Réinitialiser le mot de passe
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center mt-8 text-xs text-gray-400 italic">
            Sécurité renforcée par chiffrement de bout en bout.
        </p>
    </div>

</body>
</html>