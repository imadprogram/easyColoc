<!-- Modal Backdrop -->
<div x-show="isModalOpen" 
     class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center"
     style="display: none;" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

    <!-- Modal Content -->
    <div @click.away="isModalOpen = false" 
         x-show="isModalOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 scale-95"
         class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md mx-4">
         
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-slate-800">Nouvelle colocation</h3>
            <button @click="isModalOpen = false" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form action="{{ route('newColoc') }}" method="Post" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nom de la colocation</label>
                <input required type="text" placeholder="Ex: Maison de la Plage..." class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all outline-none" name="name">
            </div>
            <div class="flex items-center justify-end space-x-4">
                <button type="button" @click="isModalOpen = false" class="px-5 py-2.5 text-slate-500 font-bold hover:text-slate-700 transition-colors">Annuler</button>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-bold transition-colors">Créer</button>
            </div>
        </form>
    </div>
</div>