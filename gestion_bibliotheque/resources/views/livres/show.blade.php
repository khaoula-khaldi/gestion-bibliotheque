<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails | {{ $livre->titre }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="container mx-auto p-6 max-w-4xl min-h-screen flex items-center justify-center">
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden flex flex-col md:flex-row w-full">
            
            <!-- Qism l-Image (Simple) -->
            <div class="md:w-1/3 bg-gray-100 flex items-center justify-center border-b md:border-b-0 md:border-r border-gray-200">
                @if($livre->image)
                    <img src="{{ asset('storage/' . $livre->image) }}" class="w-full h-full object-cover">
                @else
                    <div class="p-20 text-gray-400 text-xs font-bold uppercase tracking-widest text-center">
                        Aucune Image <br> Disponible
                    </div>
                @endif
            </div>

            <!-- Qism l-Infos -->
            <div class="md:w-2/3 p-10">
                <div class="mb-6">
                    <span class="text-[10px] font-black bg-blue-50 text-blue-600 px-3 py-1 rounded border border-blue-100 uppercase tracking-widest">
                        {{ $livre->type }}
                    </span>
                </div>

                <h1 class="text-4xl font-black text-gray-900 mb-2 tracking-tight">{{ $livre->titre }}</h1>
                <p class="text-lg text-gray-500 font-medium mb-8">Par : <span class="text-blue-600 italic">{{ $livre->auteur->nom }}</span></p>

                <!-- Grid l-Infos Sghira -->
                <div class="grid grid-cols-2 gap-6 mb-10">
                    <div class="border-l-4 border-gray-200 pl-4">
                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-tighter">Prix d'achat</p>
                        <p class="text-xl font-black text-gray-900">{{ number_format($livre->prix_achat, 2) }} DH</p>
                    </div>
                    <div class="border-l-4 border-gray-200 pl-4">
                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-tighter">Disponibilité</p>
                        <p class="text-xl font-black {{ $livre->quantite > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $livre->quantite }} Unités
                        </p>
                    </div>
                </div>

                <div class="mb-10">
                    <h3 class="text-xs font-black text-gray-400 uppercase mb-3 tracking-widest">Description</h3>
                    <p class="text-gray-600 leading-relaxed italic border-l-2 border-gray-100 pl-4">
                        {{ $livre->description ?? 'Aucune description disponible pour cet ouvrage.' }}
                    </p>
                </div>

                <!-- Bottonat Actions (Kteba claires) -->
                <div class="flex gap-4 border-t border-gray-100 pt-8">
                    <a href="{{ route('livres.index') }}" class="px-6 py-3 border border-gray-300 text-gray-600 rounded font-bold text-xs uppercase tracking-widest hover:bg-gray-50 transition">
                        Retour au catalogue
                    </a>
                    
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('livres.edit', $livre->id) }}" class="px-6 py-3 bg-slate-900 text-white rounded font-bold text-xs uppercase tracking-widest hover:bg-slate-800 transition shadow-sm">
                            Modifier les infos
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

</body>
</html>