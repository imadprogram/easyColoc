<!-- Left Sidebar -->
<aside class="w-64 bg-white border-r border-gray-100 flex flex-col p-6 space-y-8 h-screen shrink-0">
    <!-- Logo -->
    <div class="flex items-center space-x-2 text-[#5649e7]">
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 3L4 9V21H20V9L12 3ZM12 11.5C10.6 11.5 9.5 10.4 9.5 9C9.5 7.6 10.6 6.5 12 6.5C13.4 6.5 14.5 7.6 14.5 9C14.5 10.4 13.4 11.5 12 11.5Z"/>
        </svg>
        <span class="text-2xl font-black italic tracking-tight uppercase">EasyColoc</span>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 space-y-2">
        @if(auth()->user()->is_admin)
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-[#f0f1ff] text-[#5649e7]' : 'text-slate-400' }} rounded-2xl font-bold transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
            <span>Dashboard</span>
        </a>
        @endif
        <a href="{{ route('colocation') }}" class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('colocation') ? 'bg-[#f0f1ff] text-[#5649e7]' : 'text-slate-400 hover:text-slate-600' }} rounded-2xl font-bold transition-all group">
            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <span>Colocations</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('profile.edit') ? 'bg-[#f0f1ff] text-[#5649e7]' : 'text-slate-400 hover:text-slate-600' }} rounded-2xl font-bold transition-all group">
            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <span>Profile</span>
        </a>

        <!-- Logout Form -->
        <form method="POST" action="{{ route('logout') }}" class="pt-4">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 text-rose-400 hover:text-rose-600 font-bold transition-all group">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <span>Logout</span>
            </button>
        </form>
    </nav>

    <!-- Reputation Sidebar Widget -->
    <div class="bg-[#0b101a] p-5 rounded-[2rem] shadow-2xl space-y-3 mt-auto">
        <span class="text-[10px] text-slate-400 uppercase font-bold tracking-widest">VOTRE RÉPUTATION</span>
        <div class="text-white text-xl font-bold">+{{ auth()->user()->reputation ?? 0 }} points</div>
        <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
            <div class="bg-emerald-500 h-full w-[10%]"></div>
        </div>
    </div>
</aside>
