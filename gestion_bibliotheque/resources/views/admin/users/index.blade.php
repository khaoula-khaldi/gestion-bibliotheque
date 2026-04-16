<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Utilisateurs | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-slate-900">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-800 text-white flex flex-col h-screen  top-0">
            <div class="p-6 border-b border-slate-700">
                <h2 class="text-xl font-bold">BiblioTech</h2>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Dashboard</a>
                <a href="{{ route('livres.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Catalogue Livres</a>
                
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('users.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Membres</a>
                    <a href="{{ route('emprunts.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Emprunts</a>
                    <a href="{{ route('subscriptions.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Abonnements</a>
                    <a href="{{ route('livres.create') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Ajouter Livre</a>
                    <a href="{{ route('auteurs.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion auteurs</a>
                    <a href="{{ route('achats.index') }}" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Gestion Ventes</a>
                    <a href="/profile" class="block p-3 hover:bg-slate-700 rounded text-gray-300">Mon Profil</a>
                @endif
            </nav>

            <div class="p-4 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left p-3 text-red-400 rounded">Déconnexion</button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-10 bg-white">
            
            <div class="mb-10 border-b border-black pb-5">
                <h1 class="text-2xl font-bold   text-black">Gestion des Membres</h1>
                <p class="text-xs text-gray-500">Total: {{ $users->count() }} utilisateurs inscrits.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 border border-black text-xs font-bold ">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full text-left border border-gray-200">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr class="text-[10px]  font-bold text-gray-600">
                        <th class="px-6 py-3">Utilisateur</th>
                        <th class="px-6 py-3 text-center">Statut</th>
                        <th class="px-6 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 text-sm">
                            <div class="font-bold text-black">{{ $user->name }}</div>
                            <div class="text-[10px] text-gray-400 italic">{{ $user->email }}</div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="text-[10px] font-bold  {{ $user->is_active ? 'text-green-600' : 'text-red-600' }}">
                                {{ $user->is_active ? 'Actif' : 'Banni' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('users.toggle', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-[10px] font-bold  border border-black px-4 py-2 ">
                                    {{ $user->is_active ? 'Bannir' : 'Activer' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </main>
    </div>

</body>
</html>