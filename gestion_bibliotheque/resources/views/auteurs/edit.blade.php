<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Auteur | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50">


    <!-- Main Content Centré -->
    <main class="py-12 px-6">
        <div class="max-w-2xl mx-auto">
            
            <!-- Link Retour -->
            <a href="{{ route('auteurs.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-800 mb-8 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Retour à la liste
            </a>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                    <h1 class="text-2xl font-bold text-gray-900 ">Modifier l'écrivain</h1>
                    <p class="text-sm text-gray-500 mt-1">Édition des informations de : <span class="font-semibold text-gray-700">{{ $auteur->nom }} {{ $auteur->prenom }}</span></p>
                </div>

                <form action="{{ route('auteurs.update', $auteur->id) }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Nom de famille</label>
                            <input type="text" name="nom" value="{{ old('nom', $auteur->nom) }}" 
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-50 transition outline-none text-gray-700" required>
                            @error('nom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Prénom -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Prénom</label>
                            <input type="text" name="prenom" value="{{ old('prenom', $auteur->prenom) }}" 
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-50 transition outline-none text-gray-700" required>
                            @error('prenom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Date de Naissance -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Date de Naissance</label>
                        <input type="date" name="date_naissance" value="{{ old('date_naissance', $auteur->date_naissance) }}" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-50 transition outline-none text-gray-700">
                        @error('date_naissance') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Biographie (Ila bghiti t-zidiha) -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Biographie</label>
                        <textarea name="biographie" rows="4" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-50 transition outline-none text-gray-700">{{ old('biographie', $auteur->biographie) }}</textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="pt-6 flex items-center justify-end space-x-4">
                        <a href="{{ route('auteurs.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-800 transition">
                            Annuler
                        </a>
                        <button type="submit" class="bg-gray-900 hover:bg-black text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg transition transform hover:-translate-y-0.5 active:translate-y-0">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>
</html>