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
    <div class="flex min-h-screen">
        
        <!-- Sidebar Simple -->
        <aside class="w-64 bg-slate-800 text-white flex flex-col h-screen sticky top-0">
            <div class="p-6 border-b border-slate-700">
                <h2 class="text-xl font-bold">BiblioTech</h2>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Dashboard</a>
                <a href="{{ route('livres.index') }}" class="block p-3 bg-blue-600 text-white rounded">Catalogue Livres</a>
                
                @if(auth()->user()->role === 'admin')
                    <div class="text-xs text-gray-500 uppercase p-2">Admin Tools</div>
                    <a href="{{ route('users.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Membres</a>
                    <a href="{{ route('emprunts.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Emprunts</a>
                    <a href="{{ route('subscriptions.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Abonnements</a>
                    <a href="{{ route('livres.create') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Ajouter Livre</a>
                    <a href="{{ route('auteurs.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion auteurs</a>
                    <a href="{{ route('achats.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Ventes</a>
                    <a href="/profile" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Mon Profil</a>
                @endif
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left p-3 text-red-400 hover:bg-red-500/10 rounded">Déconnexion</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="max-w-5xl mx-auto">
                
                <!-- Messages d'Alerte -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg text-sm font-medium border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg text-sm font-medium border border-red-200">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Header -->
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Liste des Auteurs</h1>
                        <p class="text-sm text-gray-500 mt-1">Gérez vos auteurs et leurs informations.</p>
                    </div>
                    <a href="{{ route('auteurs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold shadow-sm transition">
                        + Ajouter
                    </a>
                </div>

                <!-- Table Simple -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-semibold border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4">Auteur</th>
                                <th class="px-6 py-4">Date de Naissance</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($auteurs as $auteur)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $auteur->nom }} {{ $auteur->prenom }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $auteur->date_naissance ? \Carbon\Carbon::parse($auteur->date_naissance)->format('d/m/Y') : 'Non spécifiée' }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-3 text-sm">
                                    <a href="{{ route('auteurs.edit', $auteur->id) }}" class="text-blue-600 hover:underline font-medium">Modifier</a>
                                    <form action="{{ route('auteurs.destroy', $auteur->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Confirmer la suppression ?')" class="text-red-500 hover:underline font-medium">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>