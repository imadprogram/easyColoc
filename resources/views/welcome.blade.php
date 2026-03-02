<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EasyColoc') }} - La colocation simplifiée</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-[#f0f2f5] overflow-x-hidden selection:bg-indigo-500 selection:text-white">
    
    <!-- Background Design -->
    <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
        <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-indigo-500/20 blur-[120px]"></div>
        <div class="absolute top-[20%] -right-[10%] w-[40%] h-[40%] rounded-full bg-emerald-500/20 blur-[120px]"></div>
        <div class="absolute -bottom-[20%] left-[20%] w-[60%] h-[60%] rounded-full bg-blue-500/10 blur-[120px]"></div>
    </div>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/70 backdrop-blur-xl border-b border-white/50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#5649e7] text-white rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/30 transform rotate-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
                <span class="text-2xl font-black italic tracking-tighter text-slate-800 uppercase">EasyColoc</span>
            </div>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-bold text-slate-600 hover:text-indigo-600 transition-colors px-4 py-2">Mon Tableau de bord</a>
                    @else
                        <a href="{{ route('login') }}" class="font-bold text-slate-600 hover:text-indigo-600 transition-colors px-4 py-2 hidden sm:block">Connexion</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-[#5649e7] hover:bg-[#4338ca] text-white px-6 py-2.5 rounded-xl font-bold transition-all shadow-lg shadow-indigo-500/30 transform hover:-translate-y-0.5">Inscription gratuite</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-40 pb-20 lg:pt-48 lg:pb-32 px-6 overflow-hidden min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto w-full relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 lg:gap-8 items-center">
                
                <!-- Hero Content -->
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 backdrop-blur-md border border-indigo-100 shadow-sm mb-8">
                        <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-sm font-bold text-indigo-900 tracking-wide">La version 1.0 est disponible</span>
                    </div>
                    
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-slate-900 tracking-tight leading-[1.1] mb-8">
                        La vie en coloc, <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#5649e7] to-cyan-500">sans les embrouilles.</span>
                    </h1>
                    
                    <p class="text-lg sm:text-xl text-slate-500 mb-10 leading-relaxed font-medium max-w-2xl mx-auto lg:mx-0">
                        Gérez vos dépenses communes, suivez qui doit quoi à qui en temps réel, et gardez une colocation sereine grâce à notre algorithme intelligent de remboursement.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-4 bg-[#5649e7] text-white rounded-2xl font-bold text-lg hover:bg-[#4338ca] transition-all focus:ring-4 focus:ring-indigo-500/20 shadow-xl shadow-indigo-500/30 transform hover:-translate-y-1">
                                Accéder à ma coloc
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-[#5649e7] text-white rounded-2xl font-bold text-lg hover:bg-[#4338ca] transition-all focus:ring-4 focus:ring-indigo-500/20 shadow-xl shadow-indigo-500/30 transform hover:-translate-y-1">
                                Créer une colocation
                            </a>
                            <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-white text-slate-700 rounded-2xl font-bold text-lg hover:bg-slate-50 hover:text-indigo-600 transition-all border-2 border-slate-200 hover:border-indigo-200">
                                J'ai déjà un compte
                            </a>
                        @endauth
                    </div>
                    
                    <div class="mt-12 flex items-center justify-center lg:justify-start gap-6 text-sm font-bold text-slate-400">
                        <div class="flex items-center gap-2"><svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>100% Gratuit</div>
                        <div class="flex items-center gap-2"><svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Sans pub</div>
                        <div class="flex items-center gap-2"><svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Anonyme</div>
                    </div>
                </div>

                <!-- Hero Graphic (Glass Card) -->
                <div class="relative mx-auto w-full max-w-lg lg:max-w-none">
                    <div class="relative bg-white/60 backdrop-blur-2xl border border-white p-8 rounded-[3rem] shadow-2xl shadow-indigo-500/10 transform lg:rotate-2 hover:rotate-0 transition-transform duration-500">
                        
                        <!-- Mini Dashboard Mockup -->
                        <div class="space-y-6">
                            <div class="flex justify-between items-center mb-8">
                                <div>
                                    <h3 class="text-xl font-black text-slate-800">Dépenses du mois</h3>
                                    <p class="text-sm font-bold text-slate-400">Total : 450,00 €</p>
                                </div>
                                <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                <!-- Dummy Expense Item -->
                                <div class="bg-white p-4 rounded-2xl border border-slate-100 flex items-center justify-between shadow-sm">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center font-black">A</div>
                                        <div>
                                            <p class="font-bold text-slate-800">Courses Carrefour</p>
                                            <p class="text-xs font-bold text-slate-400">Il y a 2h</p>
                                        </div>
                                    </div>
                                    <span class="font-black text-slate-800 text-lg">120 €</span>
                                </div>
                                <!-- Dummy Expense Item -->
                                <div class="bg-white p-4 rounded-2xl border border-slate-100 flex items-center justify-between shadow-sm">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center font-black">B</div>
                                        <div>
                                            <p class="font-bold text-slate-800">Facture Internet</p>
                                            <p class="text-xs font-bold text-slate-400">Hier</p>
                                        </div>
                                    </div>
                                    <span class="font-black text-slate-800 text-lg">35 €</span>
                                </div>
                            </div>

                            <!-- Balance Alert Mockup -->
                            <div class="mt-8 bg-gradient-to-r from-red-50 to-rose-50 p-5 rounded-2xl border border-rose-100 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></div>
                                    <span class="font-bold text-rose-800 text-sm">A doit à B</span>
                                </div>
                                <span class="font-black text-rose-600">42,50 €</span>
                            </div>
                        </div>

                    </div>
                    
                    <!-- Floating Badge -->
                    <div class="absolute -bottom-6 -left-6 bg-slate-900 text-white p-6 rounded-3xl shadow-2xl transform -rotate-6 lg:-ml-12 border-4 border-white">
                        <div class="flex items-center gap-4">
                            <span class="text-3xl">✌️</span>
                            <div>
                                <p class="font-black text-xl leading-none">0 stress</p>
                                <p class="text-slate-400 font-bold text-sm tracking-wide">Garanti à 100%</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 tracking-tight mb-6">Tout ce qu'il faut <br>pour une coloc parfaite.</h2>
                <p class="text-lg text-slate-500 font-medium">Finis les tableaux Excel compliqués et les messages WhatsApp ignorés. EasyColoc s'occupe de tout.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-slate-50 rounded-[2.5rem] p-10 hover:bg-[#5649e7]/5 transition-colors duration-300 group">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-300">
                        <span class="text-2xl">⚖️</span>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Calcul automatique</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">Notre algorithme calcule exactement qui doit combien à qui pour minimiser le nombre de virements entre vous.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-slate-50 rounded-[2.5rem] p-10 hover:bg-[#5649e7]/5 transition-colors duration-300 group">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-300">
                        <span class="text-2xl">📊</span>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Statistiques claires</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">Visualisez vos dépenses par catégorie (courses, loyer, internet) pour mieux gérer le budget commun.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-slate-50 rounded-[2.5rem] p-10 hover:bg-[#5649e7]/5 transition-colors duration-300 group">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-300">
                        <span class="text-2xl">⭐</span>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Système de réputation</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">Récompensez les bons payeurs ! Partez sans dettes à la fin d'une colocation et augmentez votre score de réputation.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 pt-20 pb-10 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 text-center">
            <h2 class="text-3xl md:text-4xl font-black text-white mb-8">Prêt à rejoindre l'aventure ?</h2>
            @auth
                 <a href="{{ url('/dashboard') }}" class="inline-block px-8 py-4 bg-[#5649e7] text-white rounded-2xl font-bold text-lg hover:bg-[#4338ca] transition-all shadow-xl shadow-indigo-500/20 transform hover:-translate-y-1 mb-16">
                    Aller au Tableau de bord
                </a>
            @else
                <a href="{{ route('register') }}" class="inline-block px-8 py-4 bg-[#5649e7] text-white rounded-2xl font-bold text-lg hover:bg-[#4338ca] transition-all shadow-xl shadow-indigo-500/20 transform hover:-translate-y-1 mb-16">
                    Créer mon compte gratuitement
                </a>
            @endauth
            
            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row items-center justify-between text-slate-500 text-sm font-medium">
                <p>&copy; {{ date('Y') }} EasyColoc. Tous droits réservés.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition-colors">Confidentialité</a>
                    <a href="#" class="hover:text-white transition-colors">Conditions</a>
                    <a href="#" class="hover:text-white transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
