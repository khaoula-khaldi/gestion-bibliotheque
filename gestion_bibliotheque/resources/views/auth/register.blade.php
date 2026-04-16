<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#fafafa] text-slate-900 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-[420px]">
        
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold  text-black">BiblioTech</h2>
            <p class="text-slate-500 text-sm mt-2">Créez votre compte pour commencer.</p>
        </div>

        <div class="bg-white border border-white p-8 sm:p-10 shadow-sm">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="name" class="block text-[11px]   text-slate-500">Nom complet</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required  
                           class="w-full px-4 py-2.5 bg-white border border-slate-300  text-sm">
                </div>

                <div class="space-y-2">
                    <label for="email" class="block text-[11px]   text-slate-500">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                           class="w-full px-4 py-2.5 bg-white border border-slate-300  text-sm">
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <div class="space-y-2">
                        <label  class="block text-[11px]   text-slate-500">Mot de passe</label>
                        <input id="password" type="password" name="password" required 
                               class="w-full px-4 py-2.5 bg-white border border-slate-300  text-sm">
                    </div>

                    <div class="space-y-2">
                        <label  class="block text-[11px] text-slate-500">Confirmation</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required 
                               class="w-full px-4 py-2.5 bg-white border border-slate-300  text-sm">
                    </div>
                </div>

                <button type="submit" class="w-full bg-slate-900 text-white  py-3">
                    S'inscrire
                </button>
            </form>
        </div>

        <p class="text-center mt-8 text-sm text-slate-500">
            Déjà inscrit ? <a href="{{ route('login') }}" class="text-blue-600  ">Se connecter</a>
        </p>

    </div>

</body>
</html>