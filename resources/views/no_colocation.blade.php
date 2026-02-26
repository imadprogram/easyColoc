@extends('layouts.app')

@section('content')
<div x-data="{ isModalOpen: false }" class="flex flex-col h-full bg-[#f0f2f5]">
    <!-- Header -->
    <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-10 shrink-0">
        <div class="flex items-center space-x-6">
            <h1 class="text-2xl font-black italic uppercase tracking-tighter text-slate-800 flex items-center gap-3">
                <span class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </span>
                EasyColoc
            </h1>
        </div>
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

    <!-- Full page centered content -->
    <section class="flex-1 flex items-center justify-center p-10">
        <div class="text-center max-w-2xl w-full flex flex-col items-center">

            <!-- Inline SVG Illustration -->
            <div class="mb-12 relative">
                <!-- Background decorative blobs -->
                <div class="absolute -top-8 -left-8 w-48 h-48 bg-indigo-100/60 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-4 -right-4 w-36 h-36 bg-emerald-100/50 rounded-full blur-xl"></div>

                <svg class="relative z-10" width="280" height="220" viewBox="0 0 280 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Floor shadow -->
                    <ellipse cx="140" cy="205" rx="120" ry="12" fill="#e8eaed" opacity="0.6"/>

                    <!-- House body -->
                    <rect x="70" y="90" width="140" height="110" rx="12" fill="white" stroke="#e2e5ea" stroke-width="2"/>

                    <!-- Roof -->
                    <path d="M55 95 L140 30 L225 95" stroke="#5649e7" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="#eef2ff"/>

                    <!-- Chimney -->
                    <rect x="180" y="45" width="20" height="35" rx="4" fill="#c7d2fe" stroke="#5649e7" stroke-width="2"/>

                    <!-- Door -->
                    <rect x="120" y="140" width="40" height="58" rx="8" fill="#f0f0f5" stroke="#d1d5db" stroke-width="2"/>
                    <circle cx="150" cy="172" r="3" fill="#5649e7"/>

                    <!-- Left Window -->
                    <rect x="85" y="110" width="25" height="25" rx="5" fill="#eef2ff" stroke="#a5b4fc" stroke-width="2"/>
                    <line x1="97.5" y1="110" x2="97.5" y2="135" stroke="#a5b4fc" stroke-width="1.5"/>
                    <line x1="85" y1="122.5" x2="110" y2="122.5" stroke="#a5b4fc" stroke-width="1.5"/>

                    <!-- Right Window -->
                    <rect x="170" y="110" width="25" height="25" rx="5" fill="#eef2ff" stroke="#a5b4fc" stroke-width="2"/>
                    <line x1="182.5" y1="110" x2="182.5" y2="135" stroke="#a5b4fc" stroke-width="1.5"/>
                    <line x1="170" y1="122.5" x2="195" y2="122.5" stroke="#a5b4fc" stroke-width="1.5"/>

                    <!-- Person 1 (left) -->
                    <circle cx="35" cy="145" r="12" fill="#c7d2fe"/>
                    <circle cx="35" cy="138" r="7" fill="#818cf8"/>
                    <rect x="28" y="152" width="14" height="20" rx="7" fill="#818cf8"/>
                    <!-- Dotted line to house -->
                    <line x1="48" y1="160" x2="68" y2="160" stroke="#a5b4fc" stroke-width="2" stroke-dasharray="4 3"/>

                    <!-- Person 2 (right) -->
                    <circle cx="245" cy="145" r="12" fill="#a7f3d0"/>
                    <circle cx="245" cy="138" r="7" fill="#34d399"/>
                    <rect x="238" y="152" width="14" height="20" rx="7" fill="#34d399"/>
                    <!-- Dotted line to house -->
                    <line x1="232" y1="160" x2="212" y2="160" stroke="#6ee7b7" stroke-width="2" stroke-dasharray="4 3"/>

                    <!-- Plus icon floating -->
                    <circle cx="140" cy="75" r="14" fill="#5649e7" opacity="0.9"/>
                    <line x1="134" y1="75" x2="146" y2="75" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                    <line x1="140" y1="69" x2="140" y2="81" stroke="white" stroke-width="2.5" stroke-linecap="round"/>

                    <!-- Sparkle decorations -->
                    <circle cx="60" cy="60" r="3" fill="#c7d2fe"/>
                    <circle cx="230" cy="50" r="2" fill="#a7f3d0"/>
                    <circle cx="250" cy="80" r="3.5" fill="#fde68a"/>
                    <circle cx="30" cy="90" r="2.5" fill="#fca5a5"/>
                </svg>
            </div>

            <!-- Copy -->
            <h1 class="text-4xl font-black text-slate-800 tracking-tight mb-4">Pas encore de colocation</h1>

            <p class="text-slate-400 font-medium text-lg leading-relaxed mb-10 max-w-md mx-auto">
                Créez votre colocation et invitez vos colocataires pour commencer à gérer vos dépenses ensemble.
            </p>

            <!-- CTA Button -->
            <button @click="isModalOpen = true" class="bg-[#5649e7] hover:bg-[#4338ca] text-white px-10 py-4 rounded-2xl font-bold text-lg inline-flex items-center gap-3 transition-all active:scale-95 shadow-lg shadow-[#5649e7]/30 hover:shadow-xl hover:shadow-[#5649e7]/40">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Créer ma colocation
            </button>

            <p class="text-slate-400 text-sm mt-6 font-medium">Ou demandez un lien d'invitation à un colocataire.</p>
        </div>
    </section>

    @include('components.newColocModal')
</div>
@endsection
