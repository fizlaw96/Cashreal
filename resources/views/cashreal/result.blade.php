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
    <link rel="icon" type="image/png" href="{{ asset('assets/images/cashreal_logo.png') }}">
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

        @keyframes pulse-glow {
            0%, 100% { transform: scale(1); opacity: 0.45; filter: blur(42px); }
            50% { transform: scale(1.15); opacity: 0.75; filter: blur(58px); }
        }

        @keyframes float-blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(28px, -40px) scale(1.08); }
            66% { transform: translate(-16px, 18px) scale(0.94); }
        }

        @keyframes moving-gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animate-pulse-glow {
            animation: pulse-glow 4s ease-in-out infinite;
        }

        .animate-float-1 {
            animation: float-blob 19s ease-in-out infinite;
        }

        .animate-float-2 {
            animation: float-blob 24s ease-in-out infinite reverse;
        }

        .tilt-card {
            transition: transform 300ms ease-out, box-shadow 300ms ease-out;
            transform-style: preserve-3d;
        }

        .tilt-card:hover {
            transform: rotateX(4deg) rotateY(4deg) translateY(-8px);
        }

        .suggestion-card-active {
            position: relative;
            border: 2px solid transparent;
            background-clip: padding-box;
            isolation: isolate;
        }

        .suggestion-card-active::after {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 1.1rem;
            z-index: -1;
            background: linear-gradient(45deg, #13ec37, #fff4f1, #13ec37);
            background-size: 220% 220%;
            animation: moving-gradient 3.2s linear infinite;
        }

        .progress-ring__segment {
            transition: stroke-dasharray 1400ms ease-in-out, stroke-dashoffset 1400ms ease-in-out;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }

        @keyframes arrow-rise {
            0%, 100% { transform: translateY(2px); }
            50% { transform: translateY(-5px); }
        }

        @keyframes to-top-pop {
            0% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-7px) scale(1.04); }
            100% { transform: translateY(0) scale(1); }
        }

        .to-top-btn {
            position: fixed;
            right: 1.25rem;
            bottom: 1.25rem;
            z-index: 60;
            width: 3rem;
            height: 3rem;
            border-radius: 9999px;
            border: 1px solid rgba(19, 236, 55, 0.32);
            background: rgba(255, 255, 255, 0.92);
            color: #0f172a;
            box-shadow: 0 10px 25px rgba(19, 236, 55, 0.16);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: translateY(26px) scale(0.92);
            pointer-events: none;
            transition: opacity 280ms ease, transform 280ms ease, box-shadow 280ms ease;
        }

        .to-top-btn.is-visible {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .to-top-btn:hover {
            box-shadow: 0 14px 30px rgba(19, 236, 55, 0.22);
        }

        .to-top-btn .material-icons {
            font-size: 1.35rem;
            animation: arrow-rise 1.1s ease-in-out infinite;
        }

        .to-top-btn.is-pop {
            animation: to-top-pop 380ms ease;
        }

        .export-pdf-btn {
            position: fixed;
            right: 5rem;
            bottom: 1.25rem;
            z-index: 60;
            height: 3rem;
            padding: 0 0.95rem;
            border-radius: 9999px;
            border: 1px solid rgba(19, 236, 55, 0.35);
            background: rgba(255, 255, 255, 0.95);
            color: #0f172a;
            box-shadow: 0 10px 25px rgba(19, 236, 55, 0.14);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 0.03em;
            opacity: 0;
            transform: translateY(26px) scale(0.92);
            pointer-events: none;
            transition: opacity 280ms ease, transform 280ms ease, box-shadow 280ms ease;
        }

        .export-pdf-btn.is-visible {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .export-pdf-btn:hover {
            box-shadow: 0 14px 30px rgba(19, 236, 55, 0.2);
        }

        .export-pdf-btn .material-icons {
            font-size: 1rem;
        }

        @media (max-width: 640px) {
            .to-top-btn {
                right: 0.75rem;
                bottom: 0.75rem;
                width: 2.75rem;
                height: 2.75rem;
            }

            .export-pdf-btn {
                right: 0.75rem;
                bottom: 4rem;
                height: 2.75rem;
                padding: 0 0.75rem;
                font-size: 0.72rem;
            }
        }

        .result-preload #resultMain {
            opacity: 0;
            transform: translateY(88px);
        }

        .result-ready #resultMain {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 1500ms cubic-bezier(0.16, 1, 0.3, 1), transform 1500ms cubic-bezier(0.16, 1, 0.3, 1);
        }

        .result-preload .reveal-item {
            opacity: 0;
            transform: translateY(52px);
        }

        .result-ready .reveal-item.is-visible {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 1250ms cubic-bezier(0.16, 1, 0.3, 1), transform 1250ms cubic-bezier(0.16, 1, 0.3, 1);
        }

        @media (prefers-reduced-motion: reduce) {
            .result-preload #resultMain,
            .result-preload .reveal-item,
            .result-ready #resultMain,
            .result-ready .reveal-item,
            .result-ready .reveal-item.is-visible,
            .to-top-btn,
            .to-top-btn.is-visible,
            .export-pdf-btn,
            .export-pdf-btn.is-visible {
                opacity: 1;
                transform: none;
                transition: none;
            }

            .to-top-btn .material-icons {
                animation: none;
            }
        }

        @media print {
            @page {
                size: A4 landscape;
                margin: 7mm;
            }

            nav,
            .to-top-btn,
            .export-pdf-btn {
                display: none !important;
            }

            .animate-float-1,
            .animate-float-2,
            .animate-pulse-glow,
            .tilt-card {
                animation: none !important;
                transform: none !important;
            }

            body {
                background: #ffffff !important;
                font-size: 10px !important;
                line-height: 1.15 !important;
            }

            #resultMain {
                max-width: 100% !important;
                padding: 0 !important;
                zoom: 0.72;
                transform-origin: top center;
            }

            #distributionSection {
                display: grid !important;
                grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
                gap: 0.55rem !important;
            }

            #suggestionSection {
                display: grid !important;
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                gap: 0.55rem !important;
            }

            header {
                margin-bottom: 0.5rem !important;
            }

            #distributionSection,
            #suggestionSection,
            section,
            footer {
                margin-bottom: 0.5rem !important;
            }

            #distributionSection > div,
            #suggestionSection > div,
            section {
                padding: 0.7rem !important;
                border-radius: 0.6rem !important;
            }

            #distributionSection h3 {
                font-size: 1.15rem !important;
                line-height: 1.1 !important;
            }

            #distributionSection ul,
            section ul {
                gap: 0.2rem !important;
            }

            #distributionSection li,
            #suggestionSection p,
            section li {
                font-size: 0.62rem !important;
                line-height: 1.15 !important;
            }

            footer p {
                font-size: 0.9rem !important;
                line-height: 1.15 !important;
            }

            .text-6xl,
            .md\:text-8xl {
                font-size: 2rem !important;
                line-height: 1.05 !important;
            }

            .w-40.h-40 {
                width: 4.8rem !important;
                height: 4.8rem !important;
            }

            #distributionSection > *,
            #suggestionSection > *,
            section,
            footer {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>
<body class="bg-[var(--background-light)] text-slate-900 min-h-screen result-preload overflow-x-hidden">
@include('cashreal.partials.navbar')

<main id="resultMain" class="max-w-7xl mx-auto px-6 py-12">
    @php
        $needsPercent = (int) round($data['needsRatio'] * 100);
        $wantsPercent = (int) round($data['wantsRatio'] * 100);
        $savingsPercent = (int) round($data['savingsRatio'] * 100);
        $ringCircumference = 283;
        $needsLength = round($ringCircumference * $data['needsRatio'], 2);
        $wantsLength = round($ringCircumference * $data['wantsRatio'], 2);
        $savingsLength = round($ringCircumference * $data['savingsRatio'], 2);
        $wantsOffset = -$needsLength;
        $savingsOffset = -($needsLength + $wantsLength);
    @endphp

    <header class="text-center mb-16 reveal-item" data-reveal-order="0" style="--reveal-order:0">
        <h1 class="text-sm font-medium text-slate-500 uppercase tracking-[0.2em] mb-4">Total Monthly Salary</h1>
        <div class="relative inline-block">
            <div class="absolute inset-0 bg-[var(--primary)]/30 rounded-full -z-10 animate-pulse-glow"></div>
            <div class="text-5xl sm:text-6xl md:text-8xl font-black tracking-tight text-slate-900 relative">
                RM {{ number_format($data['salary'], 2) }}
            </div>
        </div>
        <p class="mt-4 text-sm font-semibold text-slate-500">{{ $data['mode'] }}</p>

        <div class="mt-10 flex justify-center">
            <div class="relative w-32 h-32 sm:w-40 sm:h-40 flex items-center justify-center">
                <svg class="w-full h-full" viewBox="0 0 100 100" aria-hidden="true">
                    <circle cx="50" cy="50" r="45" fill="transparent" stroke="#e2e8f0" stroke-width="8"></circle>
                    <circle
                        class="progress-ring__segment"
                        data-progress-segment
                        data-segment-length="{{ $needsLength }}"
                        data-segment-offset="0"
                        data-segment-delay="0"
                        cx="50"
                        cy="50"
                        r="45"
                        fill="transparent"
                        stroke="#13ec37"
                        stroke-width="8"
                        stroke-linecap="round"
                        stroke-dasharray="0 {{ $ringCircumference }}"
                        stroke-dashoffset="0"
                    ></circle>
                    <circle
                        class="progress-ring__segment"
                        data-progress-segment
                        data-segment-length="{{ $wantsLength }}"
                        data-segment-offset="{{ $wantsOffset }}"
                        data-segment-delay="160"
                        cx="50"
                        cy="50"
                        r="45"
                        fill="transparent"
                        stroke="#f59e0b"
                        stroke-width="8"
                        stroke-linecap="round"
                        stroke-dasharray="0 {{ $ringCircumference }}"
                        stroke-dashoffset="{{ $wantsOffset }}"
                    ></circle>
                    <circle
                        class="progress-ring__segment"
                        data-progress-segment
                        data-segment-length="{{ $savingsLength }}"
                        data-segment-offset="{{ $savingsOffset }}"
                        data-segment-delay="320"
                        cx="50"
                        cy="50"
                        r="45"
                        fill="transparent"
                        stroke="#3b82f6"
                        stroke-width="8"
                        stroke-linecap="round"
                        stroke-dasharray="0 {{ $ringCircumference }}"
                        stroke-dashoffset="{{ $savingsOffset }}"
                    ></circle>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-[10px] uppercase tracking-wider text-slate-500">Agihan</span>
                    <span class="text-sm font-bold tabular-nums">
                        <span data-countup data-target="{{ $needsPercent }}" data-decimals="0" data-suffix="%">0%</span>/<span data-countup data-target="{{ $wantsPercent }}" data-decimals="0" data-suffix="%">0%</span>/<span data-countup data-target="{{ $savingsPercent }}" data-decimals="0" data-suffix="%">0%</span>
                    </span>
                </div>
            </div>
        </div>
    </header>

    <section id="distributionSection" class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16 [perspective:1000px]">
        <div class="bg-[#f2fbf5] p-8 rounded-2xl border border-[#c7efd2] shadow-sm hover:shadow-xl hover:shadow-[var(--primary)]/10 transition-all reveal-item tilt-card" data-reveal-order="1" style="--reveal-order:1">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <span class="text-[var(--primary)] text-xs font-bold uppercase tracking-widest">Keperluan</span>
                    <h3 class="text-4xl font-black mt-1 tabular-nums">
                        <span data-countup data-target="{{ (int) ($data['needsRatio'] * 100) }}" data-decimals="0" data-suffix="%">0%</span>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[var(--primary)]/10 flex items-center justify-center text-[var(--primary)]">
                    <span class="material-icons">home</span>
                </div>
            </div>
            <div class="text-2xl font-bold mb-8 text-slate-700 tabular-nums">
                <span data-countup data-target="{{ $data['needs'] }}" data-decimals="2" data-prefix="RM ">RM 0.00</span>
            </div>
            <ul class="space-y-4 text-slate-600">
                @foreach($data['needsBreakdown'] as $item)
                    <li class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 sm:gap-3">
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--primary)] shrink-0"></span>
                            <div>
                                <div>{{ $item['label'] }}</div>
                                <div class="text-xs text-slate-500">{{ $item['percent'] }}% cadangan</div>
                            </div>
                        </div>
                        <span class="tabular-nums text-sm font-semibold text-slate-700 shrink-0 self-start sm:self-auto">
                            <span data-countup data-target="{{ $item['amount'] }}" data-decimals="2" data-prefix="RM ">RM 0.00</span>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="bg-[#fff7ea] p-8 rounded-2xl border border-[#ffdca9] shadow-sm hover:shadow-xl hover:shadow-amber-200/40 transition-all reveal-item tilt-card" data-reveal-order="2" style="--reveal-order:2">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <span class="text-[var(--primary)] text-xs font-bold uppercase tracking-widest">Kemahuan</span>
                    <h3 class="text-4xl font-black mt-1 tabular-nums">
                        <span data-countup data-target="{{ (int) ($data['wantsRatio'] * 100) }}" data-decimals="0" data-suffix="%">0%</span>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[var(--primary)]/10 flex items-center justify-center text-[var(--primary)]">
                    <span class="material-icons">shopping_bag</span>
                </div>
            </div>
            <div class="text-2xl font-bold mb-8 text-slate-700 tabular-nums">
                <span data-countup data-target="{{ $data['wants'] }}" data-decimals="2" data-prefix="RM ">RM 0.00</span>
            </div>
            <ul class="space-y-4 text-slate-600">
                @foreach($data['wantsBreakdown'] as $item)
                    <li class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 sm:gap-3">
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--primary)] shrink-0"></span>
                            <div>
                                <div>{{ $item['label'] }}</div>
                                <div class="text-xs text-slate-500">{{ $item['percent'] }}% cadangan</div>
                            </div>
                        </div>
                        <span class="tabular-nums text-sm font-semibold text-slate-700 shrink-0 self-start sm:self-auto">
                            <span data-countup data-target="{{ $item['amount'] }}" data-decimals="2" data-prefix="RM ">RM 0.00</span>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="bg-[#edf5ff] p-8 rounded-2xl border border-[#c8ddff] shadow-sm hover:shadow-xl hover:shadow-blue-200/40 transition-all reveal-item tilt-card" data-reveal-order="3" style="--reveal-order:3">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <span class="text-[var(--primary)] text-xs font-bold uppercase tracking-widest">Simpanan</span>
                    <h3 class="text-4xl font-black mt-1 tabular-nums">
                        <span data-countup data-target="{{ (int) ($data['savingsRatio'] * 100) }}" data-decimals="0" data-suffix="%">0%</span>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[var(--primary)]/10 flex items-center justify-center text-[var(--primary)]">
                    <span class="material-icons">trending_up</span>
                </div>
            </div>
            <div class="text-2xl font-bold mb-8 text-slate-700 tabular-nums">
                <span data-countup data-target="{{ $data['savings'] }}" data-decimals="2" data-prefix="RM ">RM 0.00</span>
            </div>
            <ul class="space-y-4 text-slate-600">
                @foreach($data['savingsBreakdown'] as $item)
                    <li class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 sm:gap-3">
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--primary)] shrink-0"></span>
                            <div>
                                <div>{{ $item['label'] }}</div>
                                <div class="text-xs text-slate-500">{{ $item['percent'] }}% cadangan</div>
                            </div>
                        </div>
                        <span class="tabular-nums text-sm font-semibold text-slate-700 shrink-0 self-start sm:self-auto">
                            <span data-countup data-target="{{ $item['amount'] }}" data-decimals="2" data-prefix="RM ">RM 0.00</span>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <div id="suggestionSection" class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <div class="bg-[#fff4f1] p-10 rounded-2xl border-2 border-[#ffd9cf] relative overflow-hidden reveal-item suggestion-card-active" data-reveal-order="4" style="--reveal-order:4">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-[var(--primary)]/5 rounded-full animate-float-1"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <span class="material-icons text-[#f07845]">roofing</span>
                    <h4 class="text-xl font-bold text-slate-800">Cadangan Rumah</h4>
                </div>
                <p class="text-slate-600 mb-6 leading-relaxed">Cadangan ansuran bulanan rumah yang lebih selamat:</p>
                @if ($wantHouse)
                    <div class="text-2xl sm:text-4xl font-black text-slate-900 tabular-nums">
                        <span data-countup data-target="{{ $data['houseMin'] }}" data-decimals="2" data-prefix="RM ">RM 0.00</span>
                        <span class="mx-1">-</span>
                        <span data-countup data-target="{{ $data['houseMax'] }}" data-decimals="2" data-prefix="RM ">RM 0.00</span>
                    </div>
                @else
                    <div class="text-2xl font-bold text-slate-400">Tidak dipilih</div>
                @endif
            </div>
        </div>

        <div class="bg-[#eefaf7] p-10 rounded-2xl border-2 border-[#cdece3] relative overflow-hidden reveal-item hover:border-[var(--primary)]/30 transition-all" data-reveal-order="5" style="--reveal-order:5">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-[var(--primary)]/5 rounded-full animate-float-2"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <span class="material-icons text-[#0f9a75]">directions_car</span>
                    <h4 class="text-xl font-bold text-slate-800">Cadangan Kereta</h4>
                </div>
                <p class="text-slate-600 mb-6 leading-relaxed">Cadangan komitmen bulanan kereta yang lebih sihat:</p>
                @if ($wantCar)
                    <div class="text-2xl sm:text-4xl font-black text-slate-900 tabular-nums">
                        <span data-countup data-target="{{ $data['carMin'] }}" data-decimals="2" data-prefix="RM ">RM 0.00</span>
                        <span class="mx-1">-</span>
                        <span data-countup data-target="{{ $data['carMax'] }}" data-decimals="2" data-prefix="RM ">RM 0.00</span>
                    </div>
                @else
                    <div class="text-2xl font-bold text-slate-400">Tidak dipilih</div>
                @endif
            </div>
        </div>
    </div>

    <section class="mb-20 bg-[#f7fbf1] p-8 rounded-2xl border border-[#dbe9c8] reveal-item" data-reveal-order="6" style="--reveal-order:6">
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

    <footer class="text-center py-12 border-t border-[var(--primary)]/10 reveal-item" data-reveal-order="7" style="--reveal-order:7">
        <p class="text-3xl font-light italic text-slate-400 tracking-tight">
            "Disiplin hari ini, <span class="text-slate-900 font-bold not-italic">bebas kewangan</span> esok."
        </p>
    </footer>
</main>

<div class="fixed top-0 left-0 -z-10 w-full h-full pointer-events-none overflow-hidden">
    <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] bg-[var(--primary)]/10 rounded-full blur-[120px] animate-float-1"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[45vw] h-[45vw] bg-amber-100/40 rounded-full blur-[100px] animate-float-2"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[60vw] h-[60vw] bg-white/45 rounded-full blur-[150px]"></div>
</div>

<button id="toTopBtn" type="button" class="to-top-btn" aria-label="Kembali ke atas">
    <span class="material-icons" aria-hidden="true">north</span>
</button>
<button id="exportPdfBtn" type="button" class="export-pdf-btn" aria-label="Export PDF">
    <span class="material-icons" aria-hidden="true">picture_as_pdf</span>
    <span>Export PDF</span>
</button>
<audio id="cashSound" preload="auto" src="{{ asset('assets/sounds/cash.mp3') }}"></audio>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const body = document.body;
        const countupNodes = Array.from(document.querySelectorAll('[data-countup]'));
        const revealItems = Array.from(document.querySelectorAll('.reveal-item')).sort((a, b) => {
            return Number(a.dataset.revealOrder || 0) - Number(b.dataset.revealOrder || 0);
        });
        const progressSegments = Array.from(document.querySelectorAll('[data-progress-segment]'));
        const toTopBtn = document.getElementById('toTopBtn');
        const exportPdfBtn = document.getElementById('exportPdfBtn');
        const cashSound = document.getElementById('cashSound');
        const distributionSection = document.getElementById('distributionSection');
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const revealDuration = 1250;
        const revealGap = 220;
        const countStartOffset = 160;
        let ringAnimated = false;
        let cardsFocused = false;
        let completedCountups = 0;
        const totalCountups = countupNodes.length;

        let shouldPlaySound = false;
        try {
            shouldPlaySound = sessionStorage.getItem('cashreal-play-sound') === '1';
            if (shouldPlaySound) {
                sessionStorage.removeItem('cashreal-play-sound');
            }
        } catch (error) {
            shouldPlaySound = false;
        }

        const formatNumber = (value, decimals) => {
            return new Intl.NumberFormat('en-US', {
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals
            }).format(value);
        };

        const setFinalValue = (node) => {
            const target = Number(node.dataset.target || 0);
            const decimals = Number(node.dataset.decimals || 0);
            const prefix = node.dataset.prefix || '';
            const suffix = node.dataset.suffix || '';
            node.textContent = `${prefix}${formatNumber(target, decimals)}${suffix}`;
        };

        const playCashSound = () => {
            if (!shouldPlaySound || !cashSound) {
                return;
            }

            cashSound.loop = true;
            cashSound.currentTime = 0;
            cashSound.play().catch(() => {
                // Autoplay may be blocked by browser policy.
            });
        };

        const stopCashSound = () => {
            if (!cashSound) {
                return;
            }

            cashSound.pause();
            cashSound.currentTime = 0;
            cashSound.loop = false;
        };

        const markCountupDone = (node) => {
            if (node.dataset.countupDone === '1') {
                return;
            }

            node.dataset.countupDone = '1';
            completedCountups += 1;

            if (completedCountups >= totalCountups) {
                stopCashSound();
            }
        };

        const animateCount = (node, delay = 0) => {
            if (node.dataset.animated === '1') {
                return;
            }
            node.dataset.animated = '1';

            const target = Number(node.dataset.target || 0);
            const decimals = Number(node.dataset.decimals || 0);
            const duration = Number(node.dataset.duration || 2800);
            const prefix = node.dataset.prefix || '';
            const suffix = node.dataset.suffix || '';

            const startAnimation = () => {
                const start = performance.now();
                const easeOut = (t) => 1 - Math.pow(1 - t, 3);

                const step = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    const eased = easeOut(progress);
                    const currentValue = target * eased;
                    const displayValue = decimals === 0 ? Math.round(currentValue) : currentValue;

                    node.textContent = `${prefix}${formatNumber(displayValue, decimals)}${suffix}`;

                if (progress < 1) {
                    requestAnimationFrame(step);
                } else {
                    setFinalValue(node);
                    markCountupDone(node);
                }
            };

                requestAnimationFrame(step);
            };

            window.setTimeout(startAnimation, delay);
        };

        const runCountups = (scope = document, delay = 0) => {
            const scopedNodes = scope === document
                ? countupNodes
                : Array.from(scope.querySelectorAll('[data-countup]'));

            scopedNodes.forEach((node) => {
                if (reduceMotion) {
                    setFinalValue(node);
                    markCountupDone(node);
                    return;
                }
                animateCount(node, delay);
            });
        };

        const sleep = (ms) => new Promise((resolve) => window.setTimeout(resolve, ms));

        const animateProgressRing = () => {
            if (progressSegments.length === 0) {
                return;
            }

            progressSegments.forEach((segment) => {
                const length = Number(segment.dataset.segmentLength || 0);
                const offset = Number(segment.dataset.segmentOffset || 0);
                const delay = Number(segment.dataset.segmentDelay || 0);

                window.setTimeout(() => {
                    segment.style.strokeDashoffset = String(offset);
                    segment.style.strokeDasharray = `${length} ${Math.max(0, 283 - length)}`;
                }, delay);
            });
        };

        const handleToTopVisibility = () => {
            if (!toTopBtn) {
                return;
            }
            if (window.scrollY > 320) {
                toTopBtn.classList.add('is-visible');
                if (exportPdfBtn) {
                    exportPdfBtn.classList.add('is-visible');
                }
            } else {
                toTopBtn.classList.remove('is-visible');
                if (exportPdfBtn) {
                    exportPdfBtn.classList.remove('is-visible');
                }
            }
        };

        const focusCardsSection = () => {
            if (cardsFocused || !distributionSection) {
                return;
            }
            cardsFocused = true;

            const topTarget = Math.max(0, window.scrollY + distributionSection.getBoundingClientRect().top - 96);
            if (reduceMotion) {
                window.scrollTo(0, topTarget);
                handleToTopVisibility();
                return;
            }

            window.scrollTo({ top: topTarget, behavior: 'smooth' });
        };

        const runSequentialReveal = async () => {
            for (const item of revealItems) {
                item.classList.add('is-visible');
                runCountups(item, countStartOffset);
                if (!ringAnimated && item.querySelector('[data-progress-segment]')) {
                    ringAnimated = true;
                    window.setTimeout(animateProgressRing, reduceMotion ? 0 : 220);
                }
                await sleep(revealDuration + revealGap);
            }
        };

        if (reduceMotion) {
            body.classList.remove('result-preload');
            body.classList.add('result-ready');
            revealItems.forEach((item) => item.classList.add('is-visible'));
            playCashSound();
            runCountups(document, 0);
            animateProgressRing();
            focusCardsSection();
            handleToTopVisibility();
            return;
        }

        if (toTopBtn) {
            window.addEventListener('scroll', handleToTopVisibility, { passive: true });
            handleToTopVisibility();

            toTopBtn.addEventListener('click', () => {
                toTopBtn.classList.add('is-pop');
                window.setTimeout(() => toTopBtn.classList.remove('is-pop'), 420);

                if (reduceMotion) {
                    window.scrollTo(0, 0);
                } else {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        }

        if (exportPdfBtn) {
            exportPdfBtn.addEventListener('click', () => {
                window.print();
            });
        }

        window.setTimeout(() => {
            requestAnimationFrame(() => {
                body.classList.remove('result-preload');
                body.classList.add('result-ready');
                playCashSound();
                runSequentialReveal();
                window.setTimeout(focusCardsSection, 760);
            });
        }, 220);
    });
</script>
</body>
</html>
