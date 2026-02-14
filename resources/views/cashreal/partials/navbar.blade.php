<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-[var(--primary)]/10">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <a href="{{ route('cashreal.home') }}" class="flex items-center gap-2">
            <div class="w-10 h-10 bg-[var(--primary)] rounded-full flex items-center justify-center">
                <span class="material-icons text-slate-900">account_balance_wallet</span>
            </div>
            <span class="text-2xl font-black tracking-tighter text-slate-900">CashReal</span>
        </a>

        <a href="{{ route('cashreal.home') }}"
           class="px-6 py-2.5 bg-[var(--primary)]/10 hover:bg-[var(--primary)]/20 text-slate-900 font-semibold rounded-full transition-all flex items-center gap-2">
            <span class="material-icons text-sm">refresh</span>
            Kira Semula
        </a>
    </div>
</nav>
