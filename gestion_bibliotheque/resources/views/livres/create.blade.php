<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Livre | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black p-5">

    <div class="max-w-xl mx-auto">
        
        <div class="mb-8">
            <h1 class="text-2xl font-bold">Nouvel Ouvrage</h1>
            <p class="text-sm text-gray-600">Ajouter un livre au catalogue.</p>
        </div>

        @if ($errors->any())
            <div class="mb-5 text-red-600 text-sm">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('livres.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm mb-1">Titre</label>
                <input type="text" name="titre" value="{{ old('titre') }}" class="w-full bg-gray-100 p-2 outline-none">
            </div>

            <div>
                <label class="block text-sm mb-1">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn') }}" class="w-full bg-gray-100 p-2 outline-none">
            </div>

            <div>
                <label class="block text-sm mb-1">Auteur</label>
                <select name="auteur_id" class="w-full bg-gray-100 p-2 outline-none">
                    <option value="">Choisir un auteur</option>
                    @foreach($auteurs as $auteur)
                        <option value="{{ $auteur->id }}" {{ old('auteur_id') == $auteur->id ? 'selected' : '' }}>{{ $auteur->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-4">
                <div class="w-1/2">
                    <label class="block text-sm mb-1">Prix Achat</label>
                    <input type="number" step="0.01" name="prix_achat" value="{{ old('prix_achat') }}" class="w-full bg-gray-100 p-2 outline-none">
                </div>
                <div class="w-1/2">
                    <label class="block text-sm mb-1">Prix Emprunt</label>
                    <input type="number" step="0.01" name="prix_emprunt" value="{{ old('prix_emprunt') }}" class="w-full bg-gray-100 p-2 outline-none">
                </div>
            </div>

            <div class="flex gap-4">
                <div class="w-1/2">
                    <label class="block text-sm mb-1">Stock</label>
                    <input type="number" name="quantite" value="{{ old('quantite') }}" class="w-full bg-gray-100 p-2 outline-none">
                </div>
                <div class="w-1/2">
                    <label class="block text-sm mb-1">Année</label>
                    <input type="number" name="annee" value="{{ old('annee') }}" class="w-full bg-gray-100 p-2 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm mb-1">Disponibilité</label>
                <select name="disponible" class="w-full bg-gray-100 p-2 outline-none">
                    <option value="1" {{ old('disponible') == '1' ? 'selected' : '' }}>Oui</option>
                    <option value="0" {{ old('disponible') == '0' ? 'selected' : '' }}>Non</option>
                </select>
            </div>

            <div>
                <label class="block text-sm mb-1">Catégorie</label>
                <select name="type" class="w-full bg-gray-100 p-2 outline-none">
                    <option value="free" {{ old('type') == 'free' ? 'selected' : '' }}>Free</option>
                    <option value="premium" {{ old('type') == 'premium' ? 'selected' : '' }}>Premium</option>
                </select>
            </div>

            <div>
                <label class="block text-sm mb-1">Image</label>
                <input type="file" name="image" class="w-full text-sm">
            </div>

            <div>
                <label class="block text-sm mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full bg-gray-100 p-2 outline-none">{{ old('description') }}</textarea>
            </div>

            <div class="pt-5 flex items-center justify-end gap-5">
                <a href="{{ route('livres.index') }}" class="text-sm">Annuler</a>
                <button type="submit" class="bg-black text-white px-6 py-2 font-bold">Créer</button>
            </div>
        </form>
    </div>

</body>
</html>