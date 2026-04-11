<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auteurs | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50">

    <main class="flex-1 p-10">
        <div class="max-w-2xl mx-auto">
            <a href="{{ route('auteurs.index') }}" class="text-slate-400 hover:text-slate-600 text-sm font-bold mb-4 block">← Retour à la liste</a>
            
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                <h2 class="text-2xl font-black text-slate-900 mb-8 border-l-4 border-blue-600 pl-4 uppercase tracking-tight">
                    {{ isset($auteur) ? 'Modifier' : 'Ajouter' }} un Auteur
                </h2>

                <form action="{{ isset($auteur) ? route('auteurs.update', $auteur->id) : route('auteurs.store') }}" method="POST">
                    @csrf
                    @if(isset($auteur)) @method('PUT') @endif

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-xs font-black uppercase text-slate-500 mb-2">Nom</label>
                            <input type="text" name="nom" value="{{ $auteur->nom ?? old('nom') }}" class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition outline-none" required>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase text-slate-500 mb-2">Prénom</label>
                            <input type="text" name="prenom" value="{{ $auteur->prenom ?? old('prenom') }}" class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition outline-none" required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-black uppercase text-slate-500 mb-2">Date de Naissance</label>
                        <input type="date" name="date_naissance" value="{{ $auteur->date_naissance ?? old('date_naissance') }}" class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:border-blue-500 outline-none">
                    </div>

                    <div class="mb-8">
                        <label class="block text-xs font-black uppercase text-slate-500 mb-2">Biographie</label>
                        <textarea name="biographie" rows="4" class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:border-blue-500 outline-none">{{ $auteur->biographie ?? old('biographie') }}</textarea>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-xl font-black uppercase tracking-widest hover:bg-blue-600 transition shadow-lg shadow-slate-200">
                        {{ isset($auteur) ? 'Mettre à jour' : 'Enregistrer' }} l'auteur
                    </button>
                </form>
            </div>
        </div>
    </main>

</body>
</html>