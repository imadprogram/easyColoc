@extends('layouts.app')

@section('content')
<div class="flex flex-col h-full bg-[#f0f2f5]">
    <!-- Top Header -->
    <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-10 shrink-0">
        <div class="flex items-center space-x-8">
            <h1 class="text-xl font-black italic uppercase tracking-tighter text-slate-800">TABLEAU DE BORD</h1>
            <button class="bg-gradient-to-r from-[#5649e7] to-[#7165f1] hover:shadow-lg hover:shadow-[#5649e7]/30 text-white px-6 py-2.5 rounded-2xl font-bold flex items-center space-x-2 transition-all transform active:scale-95">
                <span class="text-xl">+</span>
                <span>Nouvelle colocation</span>
            </button>
        </div>

        <!-- User Info -->
        <div class="flex items-center space-x-4">
            <div class="text-right">
                <div class="text-xs font-bold uppercase text-slate-900 leading-none">{{ auth()->user()->name }}</div>
                <div class="text-[10px] text-emerald-500 font-black uppercase">EN LIGNE</div>
            </div>
            <div class="w-12 h-12 bg-slate-900 text-white flex items-center justify-center rounded-2xl font-bold text-lg shadow-lg">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
        </div>
    </header>

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
                    <span class="text-4xl font-black text-slate-900">0,00 €</span>
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
                            <tr>
                                <td colspan="4" class="px-8 py-16 text-center text-slate-400 font-bold">
                                    Aucune dépense récente.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Members Card -->
            <div class="space-y-6">
                <div class="bg-[#111827] p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden h-full min-h-[250px] flex flex-col justify-center">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-white font-bold">Membres de la coloc</h3>
                        <span class="bg-slate-800 text-slate-400 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">VIDE</span>
                    </div>
                    <p class="text-slate-400 font-medium">Aucune colocation active.</p>
                    
                    <!-- Decorative background circle -->
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-slate-800/20 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection