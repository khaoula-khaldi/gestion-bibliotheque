<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Livre | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black p-5">

    <div class="max-w-xl mx-auto">
        
        <div class="mb-8">
            <h1 class="text-2xl font-bold">Modifier l'Ouvrage</h1>
            <p class="text-sm text-gray-600">Mise à jour de : {{ $livre->titre }}</p>
        </div>

        @if ($errors->any())
            <div class="mb-5 text-red-600 text-sm">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('livres.update', $livre->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm mb-1  font-bold text-[10px] ">Titre du livre</label>
                <input type="text" name="titre" value="{{ old('titre', $livre->titre) }}" class="w-full bg-gray-100 p-2 outline-none">
            </div>

            <div>
                <label class="block text-sm mb-1  font-bold text-[10px] ">Auteur</label>
                <select name="auteur_id" class="w-full bg-gray-100 p-2 outline-none">
                    @foreach($auteurs as $auteur)
                        <option value="{{ $auteur->id }}" {{ $livre->auteur_id == $auteur->id ? 'selected' : '' }}>
                            {{ $auteur->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm mb-1  font-bold text-[10px] ">Prix Emprunt (DH)</label>
                <input type="number" step="0.01" name="prix_emprunt" value="{{ old('prix_emprunt', $livre->prix_emprunt) }}" class="w-full bg-gray-100 p-2 outline-none">
            </div>

            <div>
                <label class="block text-sm mb-1  font-bold text-[10px] ">Quantité en Stock</label>
                <input type="number" name="quantite" value="{{ old('quantite', $livre->quantite) }}" class="w-full bg-gray-100 p-2 outline-none">
            </div>

            <div class="bg-gray-50 p-4">
                <label class="block text-sm mb-2  font-bold text-[10px] ">Image de couverture</label>
                <div class="flex items-center gap-4">
                    @if($livre->image)
                        <img src="{{ asset('storage/' . $livre->image) }}" class="h-16 w-12 object-cover border border-black">
                    @endif
                    <input type="file" name="image" class="text-xs">
                </div>
            </div>

            <div>
                <label class="block text-sm mb-1  font-bold text-[10px] ">Description</label>
                <textarea name="description" rows="4" class="w-full bg-gray-100 p-2 outline-none">{{ old('description', $livre->description) }}</textarea>
            </div>

            <div class="pt-5 flex items-center justify-end gap-5">
                <a href="{{ route('livres.index') }}" class="text-sm">Annuler</a>
                <button type="submit" class="bg-black text-white px-8 py-2 font-bold  text-xs">Mettre à jour</button>
            </div>
        </form>
    </div>

</body>
</html>