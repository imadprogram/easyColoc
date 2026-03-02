<!-- Modal Backdrop -->
<div x-show="isExpenseModalOpen" 
     class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center"
     style="display: none;" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

    <!-- Modal Content -->
    <div @click.away="isExpenseModalOpen = false" 
         x-show="isExpenseModalOpen" 
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
            <button @click="isExpenseModalOpen = false" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form action="{{ route('expense.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Title Input -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Titre de la dépense</label>
                <input required type="text" name="title" placeholder="Ex: Courses Carrefour" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all outline-none font-medium text-slate-800 shadow-sm sm:text-sm">
            </div>

            <!-- Amount Input -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Montant (€)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">€</span>
                    <input required type="number" step="0.01" min="1" placeholder="0.00" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all outline-none text-lg font-bold text-slate-800" name="amount">
                </div>
            </div>

            <!-- Category Select -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Catégorie</label>
                <select required name="category_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all outline-none bg-white font-medium text-slate-700 appearance-none">
                    <option value="" disabled selected>Sélectionner une catégorie...</option>
                    {{-- Dynamically load categories here later --}}
                    {{-- @foreach($colocation->categories as $category) --}}
                    {{--     <option value="{{ $category->id }}">{{ $category->name }}</option> --}}
                    {{-- @endforeach --}}
                    
                    {{-- Dummy Data for now so the UI looks complete --}}
                    @foreach ($colocation->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <!-- Custom drop arrow -->
                <div class="pointer-events-none absolute relative -top-9 right-4 text-slate-400">
                    <svg class="w-5 h-5 float-right" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                <button type="button" @click="isExpenseModalOpen = false" class="px-5 py-2.5 text-slate-500 font-bold hover:text-slate-700 transition-colors">Annuler</button>
                <button type="submit" class="bg-[#5649e7] hover:bg-[#4338ca] text-white px-6 py-2.5 rounded-xl font-bold transition-all shadow-md shadow-[#5649e7]/30">Ajouter la dépense</button>
            </div>
        </form>
    </div>
</div>