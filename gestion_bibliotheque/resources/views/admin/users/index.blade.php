<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Utilisateurs | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-slate-900">

    <div class="flex min-h-screen">
        
        <!-- 1. SIDEBAR (Simple & Dark) -->
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
        <!-- MAIN CONTENT -->
       <main class="flex-1 p-8 bg-gray-50">
    <div class="max-w-6xl mx-auto">
        
        <!-- Header: Simple u Direct -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Gestion des Membres</h1>
                <p class="text-sm text-slate-500">Activer ou bannir les comptes lecteurs.</p>
            </div>
            <div class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-sm">
                <span class="text-xs font-medium uppercase tracking-wider">Total:</span>
                <span class="text-xl font-bold">{{ $users->count() }}</span>
            </div>
        </div>

        <!-- Notification Success -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 text-sm font-bold rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tableau: Focus 3la l-muhim -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Utilisateur</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase text-center">Statut</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @foreach($users as $user)
                    <tr class="hover:bg-slate-50 transition">
                        <!-- Info User -->
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800">{{ $user->name }}</div>
                            <div class="text-xs text-slate-400">{{ $user->email }}</div>
                        </td>

                        <!-- Statut Badge -->
                        <td class="px-6 py-4 text-center">
                            @if($user->is_active)
                                <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-[10px] font-bold uppercase">Actif</span>
                            @else
                                <span class="px-2 py-1 rounded bg-red-100 text-red-700 text-[10px] font-bold uppercase">Banni</span>
                            @endif
                        </td>

                        <!-- Bouton Action -->
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('users.toggle', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 rounded-md text-[11px] font-bold uppercase transition border
                                    {{ $user->is_active 
                                        ? 'border-red-200 text-red-600 hover:bg-red-600 hover:text-white' 
                                        : 'border-emerald-200 text-emerald-600 hover:bg-emerald-600 hover:text-white' }}">
                                    {{ $user->is_active ? 'Bannir' : 'Réactiver' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <p class="mt-6 text-center text-[11px] text-slate-400 italic">Contrôle exclusif à l'administrateur.</p>

    </div>
</main>
    </div>

</body>
</html>