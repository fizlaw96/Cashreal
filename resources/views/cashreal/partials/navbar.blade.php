<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-[var(--primary)]/10">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <a href="{{ route('cashreal.home') }}" class="flex items-center gap-3">
            <img
                src="{{ asset('assets/images/cashreal_logo.png') }}"
                alt="CashReal"
                class="h-10 md:h-11 w-auto object-contain"
            >
        </a>

        <a href="{{ route('cashreal.home') }}"
           class="px-6 py-2.5 bg-[var(--primary)]/10 hover:bg-[var(--primary)]/20 text-slate-900 font-semibold rounded-full transition-all flex items-center gap-2">
            <span class="material-icons text-sm">refresh</span>
            Kira Semula
        </a>
    </div>
</nav>
