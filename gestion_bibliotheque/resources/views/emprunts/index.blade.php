<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Emprunts | BiblioTech Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-link-active { background: #2563eb; color: white; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2); }
    </style>
</head>
<body class="bg-[#fcfdfe] text-slate-900">

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
        <main class="flex-1 p-8 md:p-12">
            <div class="max-w-6xl mx-auto">
                
                <!-- Header Section -->
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h1 class="text-5xl font-black text-slate-950 tracking-tighter italic">Flux des Emprunts.</h1>
                        <p class="text-slate-400 font-medium mt-3 text-lg">Supervision et contrôle des retours de stock.</p>
                    </div>
                </div>

                <!-- Notifications -->
                @if(session('success'))
                    <div class="mb-8 p-5 bg-blue-50 border border-blue-100 text-blue-700 rounded-2xl font-bold text-sm flex items-center shadow-sm animate-pulse">
                        <span class="mr-3 italic uppercase tracking-tighter">Information :</span> {{ session('success') }}
                    </div>
                @endif

                <!-- Table Container (Clean Design) -->
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-2xl shadow-slate-200/40 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-50">
                                <th class="p-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Lecteur</th>
                                <th class="p-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Ouvrage</th>
                                <th class="p-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Transaction</th>
                                <th class="p-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Statut</th>
                                <th class="p-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($emprunts as $emprunt)
                            <tr class="group hover:bg-blue-50/30 transition duration-300">
                                <td class="p-8">
                                    <p class="font-extrabold text-slate-900 text-base mb-0.5 tracking-tight">{{ $emprunt->user->name }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">{{ $emprunt->user->email }}</p>
                                </td>
                                <td class="p-8">
                                    <p class="font-bold text-slate-700 text-sm italic border-l-2 border-blue-500 pl-3 leading-tight">{{ $emprunt->livre->titre }}</p>
                                </td>
                                <td class="p-8">
                                    <p class="font-black text-slate-950 text-base">{{ number_format($emprunt->prix, 2) }} <span class="text-[10px] text-slate-400 uppercase tracking-tighter">DH</span></p>
                                </td>
                                <td class="p-8">
                                    @if($emprunt->statut == 'en_cours' || $emprunt->statut == 'en cours')
                                        <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-orange-50 text-orange-600 text-[9px] font-black uppercase tracking-[0.1em] border border-orange-100 italic">
                                            En cours de lecture
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-[9px] font-black uppercase tracking-[0.1em] border border-emerald-100 italic">
                                            Archivé / Rendu
                                        </span>
                                    @endif
                                </td>
                                <td class="p-8 text-right">
                                    @if($emprunt->statut == 'en_cours' || $emprunt->statut == 'en cours')
                                        <form action="{{ route('emprunts.retour', $emprunt->id) }}" method="POST" onsubmit="return confirmReturn(event, this)">
                                            @csrf
                                            <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-900 transition-all hover:shadow-xl hover:shadow-blue-200 duration-300 italic">
                                                Valider Retour
                                            </button>
                                        </form>
                                    @else
                                        <div class="inline-block text-right pr-2">
                                            <p class="text-slate-400 text-[9px] font-black uppercase tracking-widest italic leading-none mb-1">Rendu le</p>
                                            <p class="text-slate-950 text-xs font-bold">{{ $emprunt->date_retour ? \Carbon\Carbon::parse($emprunt->date_retour)->format('d/m/Y') : '–' }}</p>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-32 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-px bg-slate-100 mb-6"></div>
                                        <p class="text-slate-400 font-black uppercase tracking-[0.3em] text-[10px] italic">Aucune donnée disponible</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Script SweetAlert Custom -->
    <script>
        function confirmReturn(event, form) {
            event.preventDefault();
            Swal.fire({
                title: '<span class="italic font-black uppercase tracking-tighter">Confirmation</span>',
                html: '<p class="text-slate-500 font-medium">Valider le retour de cet ouvrage et mettre à jour le stock ?</p>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: '<span class="px-4 py-2 text-xs font-black uppercase tracking-widest">Oui, confirmer</span>',
                cancelButtonText: '<span class="px-4 py-2 text-xs font-black uppercase tracking-widest text-slate-600">Annuler</span>',
                customClass: {
                    popup: 'rounded-[2rem] border-none shadow-2xl',
                    confirmButton: 'rounded-xl',
                    cancelButton: 'rounded-xl'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }
    </script>
</body>
</html>