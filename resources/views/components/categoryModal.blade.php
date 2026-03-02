<!-- Modal Backdrop -->
<div x-show="isCategoryModalOpen" 
     class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center"
     style="display: none;" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

    <!-- Modal Content -->
    <div @click.away="isCategoryModalOpen = false" 
         x-show="isCategoryModalOpen" 
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
            <button @click="isCategoryModalOpen = false" class="text-slate-400 hover:text-slate-600 border-0 bg-transparent">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form action="{{ route('category.store') ?? '#' }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Category Name Input -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nom de la catégorie</label>
                <div class="relative">
                    <input required type="text" placeholder="Ex: Courses, Internet, Loyer..." class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-gray-800 focus:ring-2 focus:ring-gray-200 transition-all outline-none font-medium text-slate-800" name="name">
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                <button type="button" @click="isCategoryModalOpen = false" class="px-5 py-2.5 text-slate-500 font-bold hover:text-slate-700 transition-colors">Annuler</button>
                <button type="submit" class="bg-gray-800 hover:bg-black text-white px-6 py-2.5 rounded-xl font-bold transition-all shadow-md">Ajouter</button>
            </div>
        </form>
    </div>
</div>
