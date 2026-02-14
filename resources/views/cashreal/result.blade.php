<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CashReal Results - Financial Breakdown</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @vite('resources/css/app.css')

    <style>
        :root {
            --primary: #13ec37;
            --background-light: #f6f8f6;
        }

        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }
    </style>
</head>
<body class="bg-[var(--background-light)] text-slate-900 min-h-screen">
@include('cashreal.partials.navbar')

<main class="max-w-7xl mx-auto px-6 py-12">
    <header class="text-center mb-16">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-[var(--primary)]/20 text-slate-900 rounded-full mb-6 border border-[var(--primary)]/20">
            <span class="material-icons text-base">verified</span>
            <span class="text-sm font-bold uppercase tracking-wider">
                Financial Health Score: {{ $data['score'] }}/100 ({{ $data['level'] }})
            </span>
        </div>
        <h1 class="text-sm font-medium text-slate-500 uppercase tracking-[0.2em] mb-4">Total Monthly Salary</h1>
        <div class="text-6xl md:text-8xl font-black tracking-tight text-slate-900">
            RM {{ number_format($data['salary'], 2) }}
        </div>
        <p class="mt-4 text-sm font-semibold text-slate-500">{{ $data['mode'] }}</p>
    </header>

    <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-[var(--primary)]/5 transition-all">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <span class="text-[var(--primary)] text-xs font-bold uppercase tracking-widest">Keperluan</span>
                    <h3 class="text-4xl font-black mt-1">{{ (int) ($data['needsRatio'] * 100) }}%</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[var(--primary)]/10 flex items-center justify-center text-[var(--primary)]">
                    <span class="material-icons">home</span>
                </div>
            </div>
            <div class="text-2xl font-bold mb-8 text-slate-700">RM {{ number_format($data['needs'], 2) }}</div>
            <ul class="space-y-4 text-slate-600">
                <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[var(--primary)]"></span>Perumahan dan utiliti</li>
                <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[var(--primary)]"></span>Makanan dan keperluan harian</li>
                <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[var(--primary)]"></span>Pengangkutan</li>
                <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[var(--primary)]"></span>Insurans dan kesihatan</li>
            </ul>
        </div>

        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-[var(--primary)]/5 transition-all">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <span class="text-[var(--primary)] text-xs font-bold uppercase tracking-widest">Kemahuan</span>
                    <h3 class="text-4xl font-black mt-1">{{ (int) ($data['wantsRatio'] * 100) }}%</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[var(--primary)]/10 flex items-center justify-center text-[var(--primary)]">
                    <span class="material-icons">shopping_bag</span>
                </div>
            </div>
            <div class="text-2xl font-bold mb-8 text-slate-700">RM {{ number_format($data['wants'], 2) }}</div>
            <ul class="space-y-4 text-slate-600">
                <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[var(--primary)]"></span>Langganan digital</li>
                <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[var(--primary)]"></span>Hobi dan hiburan</li>
                <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[var(--primary)]"></span>Travel dan gaya hidup</li>
                <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[var(--primary)]"></span>Makan luar</li>
            </ul>
        </div>

        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-[var(--primary)]/5 transition-all">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <span class="text-[var(--primary)] text-xs font-bold uppercase tracking-widest">Simpanan</span>
                    <h3 class="text-4xl font-black mt-1">{{ (int) ($data['savingsRatio'] * 100) }}%</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[var(--primary)]/10 flex items-center justify-center text-[var(--primary)]">
                    <span class="material-icons">trending_up</span>
                </div>
            </div>
            <div class="text-2xl font-bold mb-8 text-slate-700">RM {{ number_format($data['savings'], 2) }}</div>
            <ul class="space-y-4 text-slate-600">
                <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[var(--primary)]"></span>Dana kecemasan</li>
                <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[var(--primary)]"></span>Persaraan</li>
                <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[var(--primary)]"></span>Pelaburan</li>
                <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[var(--primary)]"></span>Matlamat jangka panjang</li>
            </ul>
        </div>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <div class="bg-[#fdfcf6] p-10 rounded-2xl border-2 border-[#f3eee0] relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-[var(--primary)]/5 rounded-full"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <span class="material-icons text-amber-600">roofing</span>
                    <h4 class="text-xl font-bold text-slate-800">Cadangan Rumah</h4>
                </div>
                <p class="text-slate-600 mb-6 leading-relaxed">Cadangan ansuran bulanan rumah yang lebih selamat:</p>
                @if ($wantHouse)
                    <div class="text-4xl font-black text-slate-900">
                        RM {{ number_format($data['houseMin'], 2) }} - RM {{ number_format($data['houseMax'], 2) }}
                    </div>
                @else
                    <div class="text-2xl font-bold text-slate-400">Tidak dipilih</div>
                @endif
            </div>
        </div>

        <div class="bg-[#fdfcf6] p-10 rounded-2xl border-2 border-[#f3eee0] relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-[var(--primary)]/5 rounded-full"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <span class="material-icons text-amber-600">directions_car</span>
                    <h4 class="text-xl font-bold text-slate-800">Cadangan Kereta</h4>
                </div>
                <p class="text-slate-600 mb-6 leading-relaxed">Cadangan komitmen bulanan kereta yang lebih sihat:</p>
                @if ($wantCar)
                    <div class="text-4xl font-black text-slate-900">
                        RM {{ number_format($data['carMin'], 2) }} - RM {{ number_format($data['carMax'], 2) }}
                    </div>
                @else
                    <div class="text-2xl font-bold text-slate-400">Tidak dipilih</div>
                @endif
            </div>
        </div>
    </div>

    <section class="mb-20 bg-white p-8 rounded-2xl border border-slate-200">
        <h4 class="text-xl font-bold mb-4">Nota dan Cadangan</h4>
        <ul class="space-y-3 text-slate-700">
            @forelse($data['notes'] as $note)
                <li class="flex gap-3 items-start">
                    <span class="mt-1 w-2 h-2 bg-[var(--primary)] rounded-full shrink-0"></span>
                    <span>{{ $note }}</span>
                </li>
            @empty
                <li class="text-slate-500">Aliran tunai anda dalam keadaan baik. Kekalkan disiplin perbelanjaan semasa.</li>
            @endforelse
        </ul>
    </section>

    <footer class="text-center py-12 border-t border-[var(--primary)]/10">
        <p class="text-3xl font-light italic text-slate-400 tracking-tight">
            "Disiplin hari ini, <span class="text-slate-900 font-bold not-italic">bebas kewangan</span> esok."
        </p>
    </footer>
</main>

<div class="fixed top-0 left-0 -z-10 w-full h-full opacity-30 pointer-events-none">
    <div class="absolute top-[10%] left-[5%] w-96 h-96 bg-[var(--primary)]/10 rounded-full blur-[100px]"></div>
    <div class="absolute bottom-[10%] right-[5%] w-96 h-96 bg-[var(--primary)]/10 rounded-full blur-[100px]"></div>
</div>
</body>
</html>
