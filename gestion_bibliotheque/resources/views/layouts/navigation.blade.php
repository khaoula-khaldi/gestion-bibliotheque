<nav class="flex-1 p-4 space-y-2 overflow-y-auto no-scrollbar">
    
    <div class="pb-2">
        <p class="text-[10px] uppercase font-bold text-slate-500 px-4 tracking-widest mb-2">Général</p>
        
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <span class="text-sm font-medium">Tableau de bord</span>
        </a>

        <a href="{{ route('livres.index') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('livres.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <span class="text-sm font-medium">Catalogue Livres</span>
        </a>
    </div>

    @if(auth()->user()->role === 'admin')
        <div class="pt-4 pb-2">
            <p class="text-[10px] uppercase font-bold text-slate-500 px-4 tracking-widest mb-2">Administration</p>
            
            <a href="{{ route('users.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition-all">
                <span class="text-sm font-medium">Gestion Membres</span>
            </a>

            <a href="{{ route('emprunts.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition-all">
                <span class="text-sm font-medium">Tous les Emprunts</span>
            </a>

            <a href="{{ route('auteurs.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition-all">
                <span class="text-sm font-medium">Auteurs</span>
            </a>
        </div>
    @endif

    @if(auth()->user()->role !== 'admin')
        <div class="pt-4 pb-2">
            <p class="text-[10px] uppercase font-bold text-slate-500 px-4 tracking-widest mb-2">Mon Espace</p>
            
            <a href="{{ route('emprunts.mes_emprunts') }}" class="flex items-center px-4 py-2.5 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition-all">
                <span class="text-sm font-medium">Mes Emprunts</span>
            </a>

            <a href="{{ route('achats.mes_achats') }}" class="flex items-center px-4 py-2.5 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition-all">
                <span class="text-sm font-medium">Mes Achats</span>
            </a>
        </div>
    @endif

    <div class="pt-4 border-t border-slate-800">
        <a href="/profile" class="flex items-center px-4 py-2.5 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition-all">
            <span class="text-sm font-medium">Mon Profil</span>
        </a>
    </div>

</nav>