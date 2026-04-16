<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($auteur) ? 'Modifier' : 'Ajouter' }} Auteur | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-slate-900 font-sans">

    <main class="flex-1 p-10 bg-white min-h-screen">
            
            <a href="{{ route('auteurs.index') }}" class="text-[10px] font-bold  text-gray-400 ">
                ← Retour à la liste
            </a>
            
                
                <div class="mb-10 border-b border-black pb-5">
                    <h2 class="text-2xl font-bold  tracking-tight text-black">
                        {{ isset($auteur) ? 'Modifier' : 'Ajouter' }} un Auteur
                    </h2>
                    <p class="text-[10px] text-gray-500 font-bold ">Informations biographiques</p>
                </div>

                <form action="{{ isset($auteur) ? route('auteurs.update', $auteur->id) : route('auteurs.store') }}" method="POST">
                    @csrf
                    @if(isset($auteur)) @method('PUT') @endif

                    <div class="grid grid-cols-2 gap-8 mb-8">
                        <div>
                            <label class="block text-[10px] font-black text-gray-600 mb-2">Nom</label>
                            <input type="text" name="nom" value="{{ $auteur->nom ?? old('nom') }}" 
                                class="w-full border-2 border-gray-200 px-4 py-3 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-600 mb-2">Prénom</label>
                            <input type="text" name="prenom" value="{{ $auteur->prenom ?? old('prenom') }}" 
                                class="w-full border-2 border-gray-200 px-4 py-3 text-sm" required>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-[10px] font-black text-gray-600 mb-2">Date de Naissance</label>
                        <input type="date" name="date_naissance" value="{{ $auteur->date_naissance ?? old('date_naissance') }}" 
                            class="w-full border-2 border-gray-200 px-4 py-3 text-sm">
                    </div>

                    <div class="mb-10">
                        <label class="block text-[10px] font-black text-gray-600 mb-2">Biographie</label>
                        <textarea name="biographie" rows="5" 
                            class="w-full border-2 border-gray-200 px-4 py-3 text-sm  placeholder-gray-300" 
                            placeholder="Détails sur le parcours de l'auteur...">{{ $auteur->biographie ?? old('biographie') }}</textarea>
                    </div>

                    <button type="submit" class="w-full bg-black text-white py-4 text-[10px]">
                        {{ isset($auteur) ? 'Mettre à jour' : 'Enregistrer' }} l'auteur
                    </button>
                </form>

    </main>

</body>
</html>