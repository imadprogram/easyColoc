@extends('layouts.app')

@section('content')
<div x-data="{ isModalOpen: false }" class="flex flex-col h-full bg-[#f0f2f5]">
    <!-- Top Header -->
    <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-10 shrink-0">
        <div class="flex items-center space-x-8">
            <h1 class="text-xl font-black italic uppercase tracking-tighter text-slate-800">
                {{ auth()->user()->is_global_admin ? 'ADMINISTRATION' : 'TABLEAU DE BORD' }}
            </h1>
            
            @if(!auth()->user()->is_global_admin && !auth()->user()->colocation_id)
                <button @click="isModalOpen = true" class="bg-gradient-to-r from-[#5649e7] to-[#7165f1] hover:shadow-lg hover:shadow-[#5649e7]/30 text-white px-6 py-2.5 rounded-2xl font-bold flex items-center space-x-2 transition-all transform active:scale-95">
                    <span class="text-xl">+</span>
                    <span>Nouvelle colocation</span>
                </button>
            @endif
        </div>

        <!-- User Info -->
        <div class="flex items-center space-x-4">
            <div class="text-right">
                <div class="text-xs font-bold uppercase text-slate-900 leading-none">{{ auth()->user()->name }}</div>
                <div class="text-[10px] text-emerald-500 font-black uppercase">{{ auth()->user()->is_global_admin ? 'ADMINSTRATEUR' : 'EN LIGNE' }}</div>
            </div>
            <div class="w-12 h-12 bg-slate-900 text-white flex items-center justify-center rounded-2xl font-bold text-lg shadow-lg">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
        </div>
    </header>

    @if(auth()->user()->is_global_admin)
    <!-- Admin Body -->
    <section class="flex-1 p-10 space-y-10 overflow-y-auto">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Total Users -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 flex flex-col justify-between group">
                <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <span class="text-slate-400 font-bold block text-sm mb-1 uppercase tracking-widest">Utilisateurs</span>
                    <span class="text-3xl font-black text-slate-900">{{ $totalUsers ?? 0 }}</span>
                </div>
            </div>

            <!-- Total Colocations -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 flex flex-col justify-between group">
                <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div>
                    <span class="text-slate-400 font-bold block text-sm mb-1 uppercase tracking-widest">Colocations</span>
                    <span class="text-3xl font-black text-slate-900">{{ $totalColocations ?? 0 }}</span>
                </div>
            </div>

            <!-- Volume of Expenses -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 flex flex-col justify-between group">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <div>
                    <span class="text-slate-400 font-bold block text-sm mb-1 uppercase tracking-widest">Volume Global</span>
                    <span class="text-3xl font-black text-slate-900">{{ number_format($globalVolume ?? 0, 2) }} €</span>
                </div>
            </div>

             <!-- Reports / Alerts -->
             <div class="bg-red-500 p-8 rounded-[2.5rem] shadow-xl text-white flex flex-col justify-between group relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full blur-2xl transform translate-x-5 -translate-y-5"></div>
                <div class="w-12 h-12 bg-white/20 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <span class="text-red-100 font-bold block text-sm mb-1 uppercase tracking-widest">Alertes</span>
                    <span class="text-3xl font-black text-white">{{ $bannedCount ?? 0 }} Bannissement(s)</span>
                </div>
            </div>
        </div>

        <!-- Registered Users Table -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-black text-slate-800">Gestion des utilisateurs</h2>
                    <p class="text-slate-400 font-medium">Contrôlez et gérez l'accès des membres de la plateforme.</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher..." class="bg-white border-none rounded-2xl px-6 py-3 text-sm focus:ring-2 focus:ring-[#5649e7] w-64 shadow-sm">
                        <svg class="w-4 h-4 text-slate-400 absolute right-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm border border-gray-50">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50 border-b border-gray-100">
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            <th class="px-8 py-6">UTILISATEUR</th>
                            <th class="px-10 py-6">RÔLE</th>
                            <th class="px-8 py-6 text-center">INSCRIPTION</th>
                            <th class="px-8 py-6 text-right">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($allUsers as $appUser)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center font-bold">
                                        {{ substr($appUser->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $appUser->name }}</p>
                                        <p class="text-xs text-slate-400">{{ $appUser->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                @if($appUser->is_global_admin)
                                    <span class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">Administrateur</span>
                                @else
                                    <span class="bg-slate-100 text-slate-400 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">Utilisateur</span>
                                @endif
                                
                                @if($appUser->banned_at)
                                    <span class="bg-red-50 text-red-600 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest ml-2">Banni</span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-center text-sm font-bold text-slate-500">
                                {{ $appUser->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-8 py-6 text-right">
                                @if($appUser->id !== auth()->id())
                                <form action="{{ route('ban', $appUser) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="{{ $appUser->banned_at ? 'text-indigo-600 hover:bg-indigo-50' : 'text-red-500 hover:bg-red-50' }} px-3 py-1 rounded-xl font-bold text-xs transition-all decoration-none">
                                        {{ $appUser->banned_at ? 'Débannir' : 'Bannir' }}
                                    </button>
                                </form>
                                @else
                                    <span class="text-slate-300 text-xs font-bold">Vous</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @else
    <!-- Content Body -->
    <section class="flex-1 p-10 space-y-10 overflow-y-auto">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Reputation Card -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-md transition-shadow flex items-center justify-between group">
                <div>
                    <div class="flex items-center justify-center w-14 h-14 bg-emerald-50 text-emerald-500 rounded-2xl mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    </div>
                    <span class="text-slate-400 font-bold block mb-1">Mon score réputation</span>
                    <span class="text-4xl font-black text-slate-900">{{ auth()->user()->reputation ?? 0 }}</span>
                </div>
            </div>

            <!-- Global Expenses Card -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-md transition-shadow flex items-center justify-between group">
                <div>
                    <div class="flex items-center justify-center w-14 h-14 bg-indigo-50 text-indigo-500 rounded-2xl mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <span class="text-slate-400 font-bold block mb-1">Dépenses Globales ({{ now()->format('M') }})</span>
                    <span class="text-4xl font-black text-slate-900">{{ number_format($monthlyExpenses ?? 0, 2) }} €</span>
                </div>
            </div>
        </div>

        <!-- Lower Section with Table and Sidebar -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Recent Expenses Table -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-black text-slate-800">Dépenses récentes</h2>
                    <a href="#" class="text-[#5649e7] font-bold text-sm border-b-2 border-transparent hover:border-[#5649e7] transition-all pb-1">Voir tout</a>
                </div>
                
                <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/50 border-b border-gray-100">
                            <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                <th class="px-8 py-5">TITRE / CATÉGORIE</th>
                                <th class="px-8 py-5">PAYEUR</th>
                                <th class="px-8 py-5 text-center">MONTANT</th>
                                <th class="px-8 py-5 text-right">COLOC</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentExpenses ?? [] as $expense)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-8 py-5">
                                    <p class="font-bold text-slate-800">{{ $expense->title }}</p>
                                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">{{ $expense->category->name }}</p>
                                </td>
                                <td class="px-8 py-5 text-sm font-bold text-slate-500">
                                    {{ $expense->user->name }}
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <span class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full text-xs font-black">{{ number_format($expense->amount, 2) }} €</span>
                                </td>
                                <td class="px-8 py-5 text-right text-[10px] font-black text-slate-400 uppercase">
                                    {{ $expense->colocation->name }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-16 text-center text-slate-400 font-bold">
                                    Aucune dépense récente.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Members Card -->
            <div class="space-y-6">
                <div class="bg-[#111827] p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden h-full min-h-[250px] flex flex-col justify-center">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-white font-bold">Membres de la coloc</h3>
                        <span class="bg-slate-800 text-slate-400 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">{{ ($neighbors ?? collect([]))->count() }} TOTAL</span>
                    </div>
                    
                    <div class="space-y-4">
                        @forelse($neighbors ?? [] as $neighbor)
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-slate-800 text-white flex items-center justify-center rounded-xl font-bold text-sm">
                                {{ substr($neighbor->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-white text-sm font-bold">{{ $neighbor->name }}</p>
                                <p class="text-slate-500 text-[10px] font-black uppercase tracking-tighter">Score: {{ $neighbor->reputation ?? 0 }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-slate-400 font-medium">Aucune colocation active.</p>
                        @endforelse
                    </div>
                    
                    <!-- Decorative background circle -->
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-slate-800/20 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Modal Component -->
    @include('components.newColocModal')
</div>
@endsection