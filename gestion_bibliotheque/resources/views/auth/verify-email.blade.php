<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification d'e-mail | Votre App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-gray-950 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-[500px]">
        
        <!-- Icone de Mail -->
        <div class="flex justify-center mb-8">
            <div class="w-20 h-20 bg-indigo-50 dark:bg-indigo-900/20 rounded-full flex items-center justify-center border-4 border-white dark:border-gray-800 shadow-xl">
                <svg class="w-10 h-10 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
        </div>

        <!-- Main Card -->
        <div class="bg-white dark:bg-gray-900 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] dark:shadow-none p-8 md:p-10 border border-gray-100 dark:border-gray-800 text-center">
            
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-4">Vérifiez votre e-mail</h1>
            
            <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-8">
                Merci pour votre inscription ! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer ? Si vous n'avez rien reçu, nous vous en enverrons un autre avec plaisir.
            </p>

            <!-- Success Message (Status sent) -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-8 p-4 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-100 dark:border-emerald-800 rounded-2xl text-sm font-medium text-emerald-700 dark:text-emerald-400 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Un nouveau lien de vérification a été envoyé !
                </div>
            @endif

            <div class="space-y-4">
                <!-- Action: Resend -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-100 dark:shadow-none transition-all duration-300 transform active:scale-[0.98]">
                        Renvoyer l'e-mail de vérification
                    </button>
                </form>

                <!-- Action: Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-semibold text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition-colors py-2">
                        Se déconnecter
                    </button>
                </form>
            </div>
        </div>

        <!-- Support Info -->
        <p class="text-center mt-8 text-xs text-gray-400">
            Besoin d'aide ? <a href="#" class="text-indigo-600 font-bold hover:underline">Contactez le support</a>
        </p>
    </div>

</body>
</html>