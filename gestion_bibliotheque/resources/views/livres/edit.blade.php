<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Livre | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="container mx-auto p-6 max-w-3xl">
        
        <!-- Breadcrumb / Retour -->
        <div class="mb-6">
            <a href="{{ route('livres.index') }}" class="text-sm text-blue-600 hover:underline font-medium">
                ← Retour au catalogue
            </a>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                <h1 class="text-2xl font-black text-gray-900">Modifier l'ouvrage</h1>
                <p class="text-sm text-gray-500">Modification de : <span class="italic font-bold text-gray-700">{{ $livre->titre }}</span></p>
            </div>

            <form action="{{ route('livres.update', $livre->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Titre -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Titre du livre</label>
                        <input type="text" name="titre" value="{{ old('titre', $livre->titre) }}" 
                               class="w-full border-b-2 border-gray-100 focus:border-blue-500 p-2 outline-none transition font-bold text-lg text-gray-800">
                    </div>

                    <!-- Auteur -->
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Auteur</label>
                        <select name="auteur_id" class="w-full border border-gray-200 p-3 rounded bg-white text-sm focus:ring-2 focus:ring-blue-100 outline-none">
                            @foreach($auteurs as $auteur)
                                <option value="{{ $auteur->id }}" {{ $livre->auteur_id == $auteur->id ? 'selected' : '' }}>
                                    {{ $auteur->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Prix -->
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Prix Emprunt (DH)</label>
                        <input type="number" step="0.01" name="prix_emprunt" value="{{ old('prix_emprunt', $livre->prix_emprunt) }}" 
                               class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-2 focus:ring-blue-100 outline-none font-bold text-blue-600">
                    </div>

                    <!-- Image Section -->
                    <div class="md:col-span-2 bg-slate-50 p-6 rounded-lg border border-slate-100">
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-4">Visuel de couverture</label>
                        <div class="flex items-center gap-6">
                            @if($livre->image)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $livre->image) }}" class="h-28 w-20 object-cover rounded shadow-md border border-white">
                                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition rounded"></div>
                                </div>
                            @endif
                            <div class="flex-1">
                                <p class="text-[11px] text-slate-400 mb-2 uppercase font-bold">Remplacer l'image</p>
                                <input type="file" name="image" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-black file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                            </div>
                        </div>
                    </div>

                    <!-- Quantité -->
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Quantité en Stock</label>
                        <input type="number" name="quantite" value="{{ old('quantite', $livre->quantite) }}" 
                               class="w-full border border-gray-200 p-3 rounded text-sm outline-none focus:ring-2 focus:ring-blue-100">
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Description / Résumé</label>
                        <textarea name="description" rows="4" 
                                  class="w-full border border-gray-200 p-3 rounded text-sm outline-none focus:ring-2 focus:ring-blue-100 italic text-gray-600">{{ old('description', $livre->description) }}</textarea>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="mt-10 pt-6 border-t border-gray-100 flex justify-end gap-4">
                    <a href="{{ route('livres.index') }}" class="px-8 py-3 text-xs font-black uppercase tracking-widest text-gray-400 hover:text-gray-900 transition">
                        Annuler
                    </a>
                    <button type="submit" class="px-8 py-3 bg-blue-600 text-white text-xs font-black uppercase tracking-widest rounded shadow-lg shadow-blue-200 hover:bg-blue-700 transition">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>