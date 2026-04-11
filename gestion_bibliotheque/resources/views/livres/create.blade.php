<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Livre | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="container mx-auto p-6 max-w-4xl">
        
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8 border-b border-gray-200 pb-6">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Nouvel Ouvrage</h1>
                <p class="text-sm text-gray-500">Ajouter manuellement un livre au catalogue de la bibliothèque.</p>
            </div>
            <a href="{{ route('livres.index') }}" class="text-xs font-black uppercase tracking-widest text-gray-400 hover:text-blue-600 transition">
                ← Catalogue
            </a>
        </div>

        <!-- Erreurs -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-100 text-red-600 p-4 mb-8 rounded-lg text-sm font-medium">
                <p class="font-bold mb-1 underline">Informations manquantes :</p>
                <ul class="list-disc ml-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire -->
        <form action="{{ route('livres.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            @csrf

            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Titre (Full Width) -->
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Titre complet</label>
                    <input type="text" name="titre" value="{{ old('titre') }}" placeholder="ex: L'Alchimiste" 
                           class="w-full border-b-2 border-gray-100 focus:border-blue-500 p-2 outline-none transition font-bold text-lg text-gray-800 bg-transparent">
                </div>

                <!-- ISBN -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Code ISBN</label>
                    <input type="text" name="isbn" value="{{ old('isbn') }}" placeholder="978-3-16..." 
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-2 focus:ring-blue-100 outline-none">
                </div>

                <!-- Auteur -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Auteur</label>
                    <select name="auteur_id" class="w-full border border-gray-200 p-3 rounded bg-white text-sm focus:ring-2 focus:ring-blue-100 outline-none">
                        <option value="">-- Choisir un auteur --</option>
                        @foreach($auteurs as $auteur)
                            <option value="{{ $auteur->id }}" {{ old('auteur_id') == $auteur->id ? 'selected' : '' }}>{{ $auteur->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Prix Achat -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Prix d'Achat (DH)</label>
                    <input type="number" step="0.01" name="prix_achat" value="{{ old('prix_achat') }}" 
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-2 focus:ring-blue-100 outline-none">
                </div>

                <!-- Prix Emprunt -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Prix Emprunt (DH)</label>
                    <input type="number" step="0.01" name="prix_emprunt" value="{{ old('prix_emprunt') }}" 
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-2 focus:ring-blue-100 outline-none font-bold text-blue-600">
                </div>

                <!-- Quantité -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Stock Initial</label>
                    <input type="number" name="quantite" value="{{ old('quantite') }}" 
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-2 focus:ring-blue-100 outline-none">
                </div>

                <!-- Année de Publication -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Année de Publication</label>
                    <input type="number" name="annee" value="{{ old('annee') }}" placeholder="ex: 2024" 
                        class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-2 focus:ring-blue-100 outline-none">
                </div>

                <!-- Disponibilité -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Disponibilité immédiate</label>
                    <select name="disponible" class="w-full border border-gray-200 p-3 rounded bg-white text-sm focus:ring-2 focus:ring-blue-100 outline-none">
                        <option value="1" {{ old('disponible') == '1' ? 'selected' : '' }}>Oui (Disponible)</option>
                        <option value="0" {{ old('disponible') == '0' ? 'selected' : '' }}>Non (Archivé)</option>
                    </select>
                </div>

                <!-- Type -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Catégorie</label>
                    <select name="type" class="w-full border border-gray-200 p-3 rounded bg-white text-sm focus:ring-2 focus:ring-blue-100 outline-none">
                        <option value="free">Free (Gratuit)</option>
                        <option value="premium">Premium (Abonnement)</option>
                    </select>
                </div>

                <!-- Image Upload -->
                <div class="md:col-span-2 bg-slate-50 p-6 rounded-lg border border-dashed border-slate-200">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4 text-center">Couverture du livre (JPG / PNG)</label>
                    <input type="file" name="image" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-6 file:rounded file:border-0 file:text-xs file:font-black file:bg-slate-900 file:text-white hover:file:bg-slate-800 cursor-pointer">
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Description / Résumé</label>
                    <textarea name="description" rows="4" placeholder="Résumé de l'ouvrage..." 
                              class="w-full border border-gray-200 p-3 rounded text-sm italic focus:ring-2 focus:ring-blue-100 outline-none">{{ old('description') }}</textarea>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-100 flex justify-end gap-4">
                <a href="{{ route('livres.index') }}" class="px-8 py-3 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-gray-900 transition flex items-center">
                    Annuler
                </a>
                <button type="submit" class="bg-blue-600 text-white px-10 py-3 rounded text-[10px] font-black uppercase tracking-[0.2em] shadow-lg shadow-blue-200 hover:bg-blue-700 transition">
                    Créer le livre
                </button>
            </div>
        </form>
    </div>

</body>
</html>