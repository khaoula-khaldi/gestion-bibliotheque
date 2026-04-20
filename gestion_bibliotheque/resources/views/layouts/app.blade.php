<!DOCTYPE html>
<html lang="fr" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BiblioTech')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .active-link { background-color: #1e293b; color: #60a5fa !important; border-left: 4px solid #3b82f6; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-gray-50">

    <div class="flex h-screen overflow-hidden">
        
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 w-64 bg-slate-900 text-white flex flex-col transition-transform duration-300 ease-in-out z-50 md:relative md:translate-x-0 shadow-xl h-full">
            
            <div class="p-8 border-b border-slate-800 flex justify-between items-center">
                <h2 class="text-xl font-black tracking-widest text-blue-400 uppercase">BiblioTech</h2>
                <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <nav class="flex-1 mt-6 space-y-1 overflow-y-auto no-scrollbar">
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" 
                   class="block px-8 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-white transition {{ request()->routeIs('*.dashboard') ? 'active-link' : '' }}">
                    Dashboard
                </a>

                <div class="h-[1px] bg-slate-800 my-4 mx-8"></div>

                @if(auth()->user()->role === 'admin')
                    <p class="px-8 text-[9px] font-black text-slate-600 uppercase tracking-[0.2em] mb-4">Administration</p>
                    <a href="{{ route('livres.index') }}" class="block px-8 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-white transition {{ request()->routeIs('livres.*') ? 'active-link' : '' }}">Stock Livres</a>
                    <a href="{{ route('users.index') }}" class="block px-8 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-white transition {{ request()->routeIs('users.*') ? 'active-link' : '' }}">Membres</a>
                    <a href="{{ route('auteurs.index') }}" class="block px-8 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-white transition {{ request()->routeIs('auteurs.*') ? 'active-link' : '' }}">Auteurs</a>
                @endif
                
                <a href="/profile" class="block px-8 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-white mt-4">Mon Profil</a>
            </nav>

            <div class="p-6 border-t border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-[10px] font-black text-red-400 uppercase tracking-widest hover:text-red-300 transition">
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-40 md:hidden" x-transition.opacity></div>

        <div class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
            
            <header class="h-16 bg-white border-b border-gray-100 flex items-center justify-between px-6 md:px-10 sticky top-0 z-40">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="md:hidden p-2 rounded-md text-slate-600 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em] hidden sm:inline">BiblioTech Protocol</span>
                </div>
                
                <div class="flex items-center gap-4">
                    <span class="text-[10px] font-bold text-slate-900 uppercase tracking-widest">{{ auth()->user()->name }}</span>
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white text-[10px] font-black">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            <main class="p-6 md:p-12 overflow-y-auto flex-1 bg-gray-50">
                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>