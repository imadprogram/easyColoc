@extends('layouts.app')

@section('content')
<div class="flex flex-col h-full bg-[#f0f2f5]">
    <!-- Header -->
    <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-10 shrink-0">
        <div class="flex items-center space-x-6">
            <h1 class="text-2xl font-black italic uppercase tracking-tighter text-slate-800 flex items-center gap-3">
                <span class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </span>
                Maison de la Plage
            </h1>
            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full uppercase tracking-wider">Actif</span>
        </div>

        <div class="flex items-center space-x-4">
            <button class="flex items-center space-x-2 text-slate-500 hover:text-slate-800 transition-colors font-bold text-sm bg-white border-2 border-slate-200 hover:border-slate-300 px-4 py-2 rounded-xl">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                <span>Inviter (Code: X78Y9Z)</span>
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <section class="flex-1 p-10 overflow-y-auto w-full max-w-7xl mx-auto space-y-8">
        
        <!-- Tab Navigation (Mockup) -->
        <div class="flex space-x-1 bg-gray-200/50 p-1 rounded-2xl w-fit">
            <button class="px-6 py-2.5 bg-white text-indigo-600 rounded-xl font-bold shadow-sm text-sm">Vue d'ensemble</button>
            <button class="px-6 py-2.5 text-slate-500 hover:text-slate-800 font-bold rounded-xl text-sm transition-colors">Catégories</button>
            <button class="px-6 py-2.5 text-slate-500 hover:text-slate-800 font-bold rounded-xl text-sm transition-colors">Règlements</button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Members & Quick Stats -->
            <div class="lg:col-span-1 space-y-8">
                
                <!-- Members Card -->
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-slate-800">Les Colocs</h2>
                        <span class="bg-indigo-50 text-indigo-600 font-bold px-3 py-1 rounded-full text-xs">3 membres</span>
                    </div>

                    <ul class="space-y-4">
                        <!-- User 1 -->
                        <li class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-2xl transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold shadow-md">EM</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">Emad</p>
                                    <p class="text-xs text-slate-400">Admin</p>
                                </div>
                            </div>
                            <span class="text-emerald-500 font-bold text-sm">+150 €</span>
                        </li>
                        <!-- User 2 -->
                         <li class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-2xl transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-emerald-400 to-teal-500 flex items-center justify-center text-white font-bold shadow-md">AL</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">Alex</p>
                                    <p class="text-xs text-slate-400">Membre</p>
                                </div>
                            </div>
                            <span class="text-rose-500 font-bold text-sm">-50 €</span>
                        </li>
                        <!-- User 3 -->
                         <li class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-2xl transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-400 to-orange-500 flex items-center justify-center text-white font-bold shadow-md">SO</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">Sophie</p>
                                    <p class="text-xs text-slate-400">Membre</p>
                                </div>
                            </div>
                            <span class="text-rose-500 font-bold text-sm">-100 €</span>
                        </li>
                    </ul>
                </div>

                <!-- Monthly Summary Card -->
                <div class="bg-gradient-to-br from-[#111827] to-[#1f2937] rounded-[2rem] p-8 shadow-xl text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-2xl transform translate-x-10 -translate-y-10"></div>
                    <svg class="w-8 h-8 text-indigo-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                    
                    <p class="text-slate-400 text-sm font-medium mb-1 uppercase tracking-wider">Total du mois</p>
                    <h3 class="text-4xl font-black mb-6">450,00 €</h3>
                    
                    <button class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-3 rounded-xl transition-colors shadow-lg shadow-indigo-500/30">
                        Équilibrer les comptes
                    </button>
                </div>
            </div>

            <!-- Right Column: Recent Expenses -->
            <div class="lg:col-span-2 space-y-6">
                 <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 h-full">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-xl font-bold text-slate-800">Dépenses de la colocation</h2>
                        <button class="bg-[#5649e7] hover:bg-[#4338ca] text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 transition-colors shadow-md shadow-[#5649e7]/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Ajouter
                        </button>
                    </div>

                    <div class="space-y-4">
                        <!-- Expense Item -->
                        <div class="group flex items-center justify-between p-5 border border-gray-50 hover:border-indigo-100 hover:bg-slate-50/50 rounded-2xl transition-all">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 text-base">Courses Carrefour</p>
                                    <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                                        <span>Aujourd'hui</span>
                                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                        <span>Payé par <span class="font-bold text-indigo-600">Emad</span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-black text-slate-800 text-lg">120.00 €</p>
                                <p class="text-xs text-slate-400 font-medium line-through group-hover:block">Nourriture</p>
                            </div>
                        </div>

                         <!-- Expense Item -->
                        <div class="group flex items-center justify-between p-5 border border-gray-50 hover:border-indigo-100 hover:bg-slate-50/50 rounded-2xl transition-all">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 text-base">Facture Électricité</p>
                                    <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                                        <span>12 Feb</span>
                                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                        <span>Payé par <span class="font-bold text-indigo-600">Sophie</span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-black text-slate-800 text-lg">85.50 €</p>
                                <p class="text-xs text-slate-400 font-medium group-hover:block">Factures</p>
                            </div>
                        </div>

                         <!-- Expense Item -->
                        <div class="group flex items-center justify-between p-5 border border-gray-50 hover:border-indigo-100 hover:bg-slate-50/50 rounded-2xl transition-all">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 text-base">Internet Box</p>
                                    <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                                        <span>1 Feb</span>
                                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                        <span>Payé par <span class="font-bold text-indigo-600">Alex</span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-black text-slate-800 text-lg">34.99 €</p>
                                <p class="text-xs text-slate-400 font-medium group-hover:block">Abonnements</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- View all link -->
                    <div class="mt-6 text-center">
                        <a href="#" class="text-indigo-600 font-bold text-sm hover:text-indigo-800 transition-colors">Voir l'historique complet</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
