@extends('layouts.app')

@section('content')
<div x-data="{ isExpenseModalOpen: false, isCategoryModalOpen: false }" class="flex flex-col h-full bg-[#f0f2f5] relative">
    <!-- Validation Errors & Flash Messages -->
    <div class="px-8 pt-6 w-full max-w-[1600px] mx-auto space-y-4 z-10 relative">
        @if ($errors->any())
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-xl shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0"><svg class="h-5 w-5 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-rose-800">Please correct these errors:</h3>
                        <div class="mt-2 text-sm text-rose-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl shadow-sm flex items-center">
                <svg class="w-5 h-5 text-emerald-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="text-emerald-800 font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-xl shadow-sm flex items-center">
                <svg class="w-5 h-5 text-rose-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <span class="text-rose-800 font-bold text-sm">{{ session('error') }}</span>
            </div>
        @endif
    </div>
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

        @if($colocation->owner_id === auth()->user()->id)
        <div class="flex items-center space-x-4 relative" x-data="{ showToast: false }">
            <!-- Cancel Button -->
            <form action="{{ route('colocation.cancel') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler la colocation ?')">
                @csrf
                <button type="submit" class="text-rose-500 hover:text-rose-700 font-bold text-xs uppercase tracking-widest border border-rose-100 hover:bg-rose-50 px-3 py-2 rounded-xl transition-all">
                    Annuler colocation
                </button>
            </form>

            <button @click="navigator.clipboard.writeText('{{ url()->current() . '/invite/' . $colocation->invite_token }}'); showToast = true; setTimeout(() => showToast = false, 3000)" class="flex items-center space-x-2 text-slate-500 hover:text-slate-800 transition-colors font-bold text-sm bg-white border-2 border-slate-200 hover:border-slate-300 px-4 py-2 rounded-xl">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                <span x-clipboard.raw="{{url()->current() . '/invite/' . $colocation->invite_token }}">Invitation</span>
            </button>
        </div>
        @else
        <div class="flex items-center space-x-4">
             <!-- Leave Button -->
             <form action="{{ route('colocation.leave') }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment quitter la colocation ?')">
                @csrf
                <button type="submit" class="text-rose-500 hover:text-rose-700 font-bold text-xs uppercase tracking-widest border border-rose-100 hover:bg-rose-50 px-4 py-2 rounded-xl transition-all">
                    Quitter coloc
                </button>
            </form>
        </div>
        @endif
    </header>

    <!-- Main Content -->
    <section class="flex-1 p-8 overflow-y-auto w-full max-w-[1600px] mx-auto">
        
        <!-- Welcome Header Logic -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Tableau de bord</h2>
                <p class="text-slate-400 font-bold text-sm uppercase tracking-widest mt-1">Gérez votre vie en communauté</p>
            </div>
            
            <div class="flex items-center gap-3">
                @if($colocation->owner_id === auth()->user()->id)
                <button @click="$dispatch('open-category-modal')" class="bg-white hover:bg-slate-50 text-slate-700 px-6 py-3 rounded-2xl font-bold flex items-center gap-3 transition-all shadow-sm border border-slate-200">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Nouvelle Catégorie
                </button>
                @endif
                <button @click="$dispatch('open-expense-modal')" class="bg-[#5649e7] hover:bg-[#4338ca] text-white px-8 py-3 rounded-2xl font-bold flex items-center gap-3 transition-all shadow-lg shadow-indigo-500/25">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Ajouter une dépense
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- Left Column: Members & Quick Stats -->
            <div class="xl:col-span-3 space-y-8">
                
                <!-- Members Card -->
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 relative overflow-scroll [scrollbar-width:none] max-h-80">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-slate-800">Les Colocs</h2>
                        <span class="bg-indigo-50 text-indigo-600 font-bold px-3 py-1 rounded-full text-xs">{{ $colocation->users->count() }} membres</span>
                    </div>

                    <ul class="space-y-4">
                        <!-- User 1 -->
                        @foreach($colocation->users as $member)
                        <li class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-2xl transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold shadow-md">{{ $member->name[0] }}</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">{{ $member->name}}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Réput: {{ $member->reputation ?? 0 }}</p>
                                </div>
                            </div>
                            
                            <!-- Kick mechanism (Owner only) -->
                            @if($colocation->owner_id === auth()->id() && $member->id !== auth()->id())
                            <form action="{{ route('colocation.kick', $member) }}" method="POST" onsubmit="return confirm('Retirer ce membre ? Ses dettes seront imputées à vous.')">
                                @csrf
                                <button type="submit" class="text-slate-300 hover:text-rose-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a5 5 0 0110 0v1a6 6 0 00-6 6H9v-1a6 6 0 016 0V14z"></path></svg>
                                </button>
                            </form>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Monthly Summary Card -->
                <div class="bg-gradient-to-br from-[#111827] to-[#1f2937] rounded-[2rem] p-8 shadow-xl text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-2xl transform translate-x-10 -translate-y-10"></div>
                    <svg class="w-8 h-8 text-indigo-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                    
                    <p class="text-slate-400 text-sm font-medium mb-1 uppercase tracking-wider">Total du mois</p>
                    <h3 class="text-4xl font-black mb-6"> {{ $colocation->expenses->sum('amount') }} €</h3>
                    
                    <form action="{{ route('settlement.calculate') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-3 rounded-xl transition-colors shadow-lg shadow-indigo-500/30">
                            Équilibrer les comptes
                        </button>
                    </form>
                </div>
            </div>

            <!-- Middle Column: Stats & Expenses (Wider) -->
            <div class="lg:col-span-6 space-y-10">
                 
                 <!-- Category Statistics -->
                 <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-xl font-bold text-slate-800 flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path></svg>
                            </div>
                            Stats par catégorie
                        </h2>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        @forelse($categoryStats as $stat)
                        <div class="p-6 bg-slate-50/50 rounded-3xl border border-slate-100 group hover:border-indigo-100 hover:bg-white transition-all duration-300">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">{{ $stat['name'] }}</p>
                            <p class="text-2xl font-black text-slate-900">{{ number_format($stat['total'], 2) }} €</p>
                        </div>
                        @empty
                        <div class="col-span-full py-8 text-center text-slate-400 font-medium bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                            Aucune statistique disponible pour cette période.
                        </div>
                        @endforelse
                    </div>
                 </div>

                 <!-- Detailed Expenses -->
                 <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <h2 class="text-xl font-bold text-slate-800">Historique local</h2>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Dépenses de la communauté</p>
                        </div>
                        
                        <form action="{{ route('colocation') }}" method="GET" x-ref="filterForm" class="relative">
                            <select name="month" @change="$refs.filterForm.submit()" class="bg-slate-50 border-none rounded-2xl text-xs font-black text-slate-600 focus:ring-4 focus:ring-indigo-50 px-6 py-3 pr-12 appearance-none shadow-sm cursor-pointer hover:bg-slate-100 transition-colors">
                                <option value="">Tous les mois</option>
                                @foreach($availableMonths as $m)
                                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::parse($m)->translatedFormat('F Y') }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </form>
                    </div>

                    <div class="space-y-4 max-h-[600px] overflow-y-auto pr-2 [scrollbar-width:thin] [scrollbar-color:#e2e8f0_transparent]">
                        @forelse($expenses as $expense)
                        <div class="group flex items-center justify-between p-6 border border-slate-50 hover:border-indigo-100 hover:bg-slate-50/50 rounded-3xl transition-all duration-300 gap-6">
                            <div class="flex items-center gap-5 overflow-hidden">
                                <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </div>
                                <div class="truncate">
                                    <p class="font-bold text-slate-900 text-lg truncate mb-1">{{ $expense->title }}</p>
                                    <div class="flex items-center gap-2 text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                                        <span class="bg-slate-100 px-2 py-0.5 rounded text-indigo-500">{{ $expense->category->name }}</span>
                                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                        <span>{{ $expense->user->name}}</span>
                                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                        <span>{{ $expense->created_at->translatedFormat('d M') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right whitespace-nowrap">
                                <p class="font-black text-slate-900 text-xl">{{ number_format($expense->amount, 2) }} €</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-20 bg-slate-50 rounded-[2rem] border border-dashed border-slate-200">
                            <p class="font-bold text-slate-400 uppercase tracking-widest text-sm">Aucune dépense trouvée</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

            <!-- Right Column: Settlements -->
            <div class="lg:col-span-3 space-y-8">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 sticky top-0">
                    <div class="flex justify-between items-center mb-10">
                        <h2 class="text-xl font-bold text-slate-800">Dettes</h2>
                        <span class="bg-emerald-50 text-emerald-600 font-bold px-4 py-1 rounded-full text-[10px] uppercase tracking-widest">En cours</span>
                    </div>

                    <div class="space-y-6">
                        @forelse($settlements as $settlement)
                        <div class="flex flex-col gap-4 p-6 border border-slate-50 bg-slate-50/50 hover:bg-white hover:shadow-md transition-all duration-300 rounded-3xl">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center -space-x-3">
                                    <div class="w-10 h-10 bg-rose-100 text-rose-600 rounded-2xl flex items-center justify-center font-black text-xs border-2 border-white">
                                        {{ substr($settlement->debtor->name, 0, 1) }}
                                    </div>
                                    <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center font-black text-xs border-2 border-white">
                                        {{ substr($settlement->creditor->name, 0, 1) }}
                                    </div>
                                </div>
                                <p class="font-black text-slate-900 text-xl">{{ number_format($settlement->amount, 2) }} €</p>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">{{ $settlement->debtor->name }} ➔ {{ $settlement->creditor->name }}</span>
                                @if(auth()->id() === $settlement->debtor_id)
                                <form action="{{ route('settlement.paid', $settlement) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl font-bold text-[10px] transition-all shadow-md shadow-indigo-500/20">
                                        Payer
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-16 px-4 bg-slate-50 rounded-[2rem] border border-dashed border-slate-200">
                            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm">
                                <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <p class="text-slate-500 font-black text-xs uppercase tracking-widest leading-loose">Comptes à jour !</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </section>


</div>
@endsection

@push('modals')
<!-- Expense Modal -->
<div x-data="{ open: false }" @open-expense-modal.window="open = true">
    <div x-show="open" 
         class="fixed inset-0 z-[9999] bg-black/50 backdrop-blur-sm flex items-center justify-center"
         style="display: none;" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div @click.away="open = false" 
             x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Nouvelle Dépense
                </h3>
                <button @click="open = false" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('expense.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Titre de la dépense</label>
                    <input required type="text" name="title" placeholder="Ex: Courses Carrefour" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all outline-none font-medium text-slate-800 shadow-sm sm:text-sm">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Montant (€)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">€</span>
                        <input required type="number" step="0.01" min="1" placeholder="0.00" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all outline-none text-lg font-bold text-slate-800" name="amount">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Catégorie</label>
                    <select required name="category_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all outline-none bg-white font-medium text-slate-700">
                        <option value="" disabled selected>Sélectionner une catégorie...</option>
                        @foreach ($colocation->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                    <button type="button" @click="open = false" class="px-5 py-2.5 text-slate-500 font-bold hover:text-slate-700 transition-colors">Annuler</button>
                    <button type="submit" class="bg-[#5649e7] hover:bg-[#4338ca] text-white px-6 py-2.5 rounded-xl font-bold transition-all shadow-md shadow-[#5649e7]/30">Ajouter la dépense</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Category Modal -->
<div x-data="{ open: false }" @open-category-modal.window="open = true">
    <div x-show="open" 
         class="fixed inset-0 z-[9999] bg-black/50 backdrop-blur-sm flex items-center justify-center"
         style="display: none;" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div @click.away="open = false" 
             x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Nouvelle Catégorie
                </h3>
                <button @click="open = false" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('category.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nom de la catégorie</label>
                    <input required type="text" placeholder="Ex: Courses, Internet, Loyer..." class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-gray-800 focus:ring-2 focus:ring-gray-200 transition-all outline-none font-medium text-slate-800" name="name">
                </div>
                <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                    <button type="button" @click="open = false" class="px-5 py-2.5 text-slate-500 font-bold hover:text-slate-700 transition-colors">Annuler</button>
                    <button type="submit" class="bg-gray-800 hover:bg-black text-white px-6 py-2.5 rounded-xl font-bold transition-all shadow-md">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush
