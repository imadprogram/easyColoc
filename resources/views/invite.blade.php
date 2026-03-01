<x-app-layout>
    <div class="py-12 flex justify-center items-center min-h-[80vh]">
        <div class="max-w-xl w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-[2.5rem] border border-gray-100 p-10 text-center">
                
                <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6 transform hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>

                <h2 class="text-3xl font-black text-slate-900 mb-2">Invitation à rejoindre</h2>
                <h3 class="text-2xl font-bold text-indigo-600 mb-6">{{ $colocation->name }}</h3>
                
                <p class="text-slate-500 font-medium mb-10 text-lg leading-relaxed">
                    Vous avez été invité(e) par <span class="font-bold text-slate-800">{{ $colocation->owner->name }}</span> à rejoindre cette colocation.
                    <br>
                    <span class="text-sm">Souhaitez-vous faire partie de l'aventure ?</span>
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <!-- Decline Button -->
                    <form action="{{ route('colocation.decline') }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-white text-slate-600 font-bold rounded-2xl border-2 border-slate-200 hover:border-rose-200 hover:bg-rose-50 hover:text-rose-600 transition-all duration-300">
                            Décliner
                        </button>
                    </form>

                    <!-- Accept Button -->
                    <form action="{{ route('invite.accept', $colocation->invite_token) }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-[#5649e7] hover:bg-[#4338ca] text-white font-bold rounded-2xl shadow-lg shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1">
                            Accepter l'invitation
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
