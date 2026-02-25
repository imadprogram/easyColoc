<x-app-layout>
    <div class="flex flex-col h-full bg-[#f0f2f5]">
        <!-- Top Header -->
        <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-10 shrink-0">
            <h1 class="text-xl font-black italic uppercase tracking-tighter text-slate-800">MON PROFIL</h1>
            
            <!-- User Info (Matches Dashboard) -->
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
            <div class="max-w-4xl space-y-10">
                <!-- Update Profile Information -->
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
    
                <!-- Delete User -->
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border-2 border-rose-50/50">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
