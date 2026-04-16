<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnements | BiblioTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-slate-900 font-sans">

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
            <div class="max-w-6xl mx-auto">
                
                <div class="mb-10 border-b border-black pb-5">
                    <h1 class="text-2xl font-bold   text-black">Abonnements</h1>
                    <p class="text-[10px] text-gray-500 font-bold ">Membres et validité des comptes</p>
                </div>

                <div class="border border-black">
                    <table class="w-full text-left">
                        <thead class="bg-gray-100 border-b border-black text-[10px] font-black text-gray-600">
                            <tr>
                                <th class="p-6">Membre</th>
                                <th class="p-6 text-center">Type</th>
                                <th class="p-6">Période</th>
                                <th class="p-6 text-right">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($subscriptions as $sub)
                            <tr class="">
                                <td class="p-6">
                                    <div class="text-sm font-bold text-black">{{ $sub->user->name }}</div>
                                    <div class="text-[10px] text-gray-400 ">{{ $sub->user->email }}</div>
                                </td>
                                <td class="p-6 text-center">
                                    <span class="px-3 py-1 text-[9px] font-bold  border border-black {{ $sub->type === 'annuel' ? 'bg-black text-white' : 'bg-white text-black' }}">
                                        {{ $sub->type }}
                                    </span>
                                </td>
                                <td class="p-6">
                                    <div class="text-xs font-medium text-black">
                                        {{ \Carbon\Carbon::parse($sub->date_debut)->format('d/m/Y') }} 
                                        <span class="mx-2 text-gray-300">→</span> 
                                        {{ \Carbon\Carbon::parse($sub->date_fin)->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="p-6 text-right">
                                    @if($sub->statut === 'actif')
                                        <span class="text-[10px] font-bold  text-green-700 bg-green-50 px-2 py-1">Actif</span>
                                    @else
                                        <span class="text-[10px] font-bold  text-red-700 bg-red-50 px-2 py-1">Expiré</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-20 text-center text-gray-400 text-xs font-bold ">
                                    Aucun abonnement trouvé.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <p class="mt-12 text-center text-[10px] text-gray-400  font-bold">
                    Administration • BiblioTech
                </p>

            </div>
        </main>
    </div>

</body>
</html>