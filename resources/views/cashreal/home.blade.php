<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CashReal - Bijak Bahagi Gaji</title>
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

        .input-no-spinner::-webkit-inner-spin-button,
        .input-no-spinner::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body class="bg-[var(--background-light)] text-slate-800 min-h-screen flex flex-col">
@include('cashreal.partials.navbar')

<main class="flex-grow flex flex-col items-center justify-start px-4 sm:px-6 pt-4 sm:pt-5 pb-6">
    <div class="max-w-2xl w-full text-center space-y-6 sm:space-y-8">
        <div class="space-y-3">
            <h1 class="text-3xl sm:text-4xl md:text-6xl font-extrabold tracking-tight text-slate-900">
                Bijak Bahagi <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[var(--primary)] to-green-600">Gaji Anda</span>
            </h1>
            <p class="text-sm sm:text-base md:text-lg text-slate-500 font-medium">
                Masukkan gaji dan lihat pembahagian automatik secara eksklusif.
            </p>
        </div>

        <form id="cashrealCalcForm" method="POST" action="{{ route('cashreal.result') }}" class="space-y-6">
            @csrf

            <div class="relative max-w-lg mx-auto w-full group">
                <div class="absolute inset-y-0 left-8 flex items-center pointer-events-none">
                    <span class="text-3xl font-bold text-slate-300 group-focus-within:text-[var(--primary)] transition-colors">RM</span>
                </div>
                <input
                    id="salaryInput"
                    type="text"
                    name="salary"
                    inputmode="numeric"
                    pattern="[0-9]*"
                    maxlength="9"
                    autocomplete="off"
                    aria-describedby="salaryHelp"
                    placeholder="3,500"
                    value="{{ old('salary') }}"
                    class="input-no-spinner block w-full pl-20 sm:pl-24 pr-6 sm:pr-8 py-4 sm:py-5 text-2xl sm:text-3xl font-bold bg-white border-none rounded-full shadow-2xl shadow-[var(--primary)]/5 focus:ring-4 focus:ring-[var(--primary)]/20 transition-all placeholder:text-slate-200"
                    required
                >
                <label class="absolute -top-3 left-10 bg-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest text-slate-400">
                    Gaji Bulanan
                </label>
            </div>
            <p id="salaryHelp" class="-mt-3 text-xs text-slate-500">Gunakan nombor sahaja, contoh: 3500</p>

            @error('salary')
                <p class="text-red-600 text-sm font-semibold -mt-6">{{ $message }}</p>
            @enderror

            <div class="space-y-4">
                <p class="text-sm font-bold uppercase tracking-widest text-slate-400">Pilih Matlamat Utama</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label class="cursor-pointer">
                        <input type="checkbox" name="house" value="1" class="peer sr-only" {{ old('house') ? 'checked' : '' }}>
                        <div class="bg-[#fcfcf4] border-2 border-transparent peer-checked:border-[var(--primary)] peer-checked:bg-[#f6fff7] p-5 rounded-2xl flex flex-col items-center text-center gap-3 transition-all hover:-translate-y-1">
                            <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 peer-checked:bg-[var(--primary)]/20 peer-checked:text-[var(--primary)] transition-colors">
                                <span class="material-icons text-2xl">home_work</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-base text-slate-800">Nak Beli Rumah</h3>
                                <p class="text-xs text-slate-500 mt-1">Deposit dan ansuran</p>
                            </div>
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="checkbox" name="car" value="1" class="peer sr-only" {{ old('car') ? 'checked' : '' }}>
                        <div class="bg-[#fcfcf4] border-2 border-transparent peer-checked:border-[var(--primary)] peer-checked:bg-[#f6fff7] p-5 rounded-2xl flex flex-col items-center text-center gap-3 transition-all hover:-translate-y-1">
                            <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 peer-checked:bg-[var(--primary)]/20 peer-checked:text-[var(--primary)] transition-colors">
                                <span class="material-icons text-2xl">directions_car</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-base text-slate-800">Nak Beli Kereta</h3>
                                <p class="text-xs text-slate-500 mt-1">Komitmen kenderaan</p>
                            </div>
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="checkbox" name="married" value="1" class="peer sr-only" {{ old('married') ? 'checked' : '' }}>
                        <div class="bg-[#fcfcf4] border-2 border-transparent peer-checked:border-[var(--primary)] peer-checked:bg-[#f6fff7] p-5 rounded-2xl flex flex-col items-center text-center gap-3 transition-all hover:-translate-y-1">
                            <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 peer-checked:bg-[var(--primary)]/20 peer-checked:text-[var(--primary)] transition-colors">
                                <span class="material-icons text-2xl">diversity_1</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-base text-slate-800">Sudah Berkahwin</h3>
                                <p class="text-xs text-slate-500 mt-1">Nafkah isteri</p>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="pt-1">
                <button
                    type="submit"
                    class="w-full max-w-lg bg-[var(--primary)] hover:bg-green-500 text-white py-4 rounded-full text-lg font-extrabold shadow-xl shadow-[var(--primary)]/30 active:scale-[0.98] transition-all inline-flex items-center justify-center gap-3"
                >
                    Kira Sekarang
                    <span class="material-icons">arrow_forward</span>
                </button>
                <p class="mt-3 text-xs text-slate-400 font-medium">
                    Tiada pendaftaran diperlukan untuk pengiraan awal.
                </p>
            </div>
        </form>
    </div>
</main>

<div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 overflow-hidden">
    <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-[var(--primary)]/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-[var(--primary)]/5 rounded-full blur-3xl"></div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const calcForm = document.getElementById('cashrealCalcForm');
        const salaryInput = document.getElementById('salaryInput');
        if (!calcForm) {
            return;
        }

        if (salaryInput) {
            salaryInput.addEventListener('input', () => {
                const numbersOnly = salaryInput.value.replace(/\D+/g, '');
                salaryInput.value = numbersOnly.replace(/^0+(?=\d)/, '');
                salaryInput.setCustomValidity('');
            });

            salaryInput.addEventListener('blur', () => {
                if (salaryInput.value.trim() === '' || Number(salaryInput.value) < 1) {
                    salaryInput.setCustomValidity('Masukkan nombor gaji yang sah.');
                } else {
                    salaryInput.setCustomValidity('');
                }
            });
        }

        calcForm.addEventListener('submit', (event) => {
            if (salaryInput) {
                const numbersOnly = salaryInput.value.replace(/\D+/g, '');
                salaryInput.value = numbersOnly.replace(/^0+(?=\d)/, '');
                if (salaryInput.value === '' || Number(salaryInput.value) < 1) {
                    salaryInput.setCustomValidity('Masukkan nombor gaji yang sah.');
                    salaryInput.reportValidity();
                    event.preventDefault();
                    return;
                }
                salaryInput.setCustomValidity('');
            }

            try {
                sessionStorage.setItem('cashreal-play-sound', '1');
            } catch (error) {
                // Ignore storage errors silently.
            }
        });
    });
</script>
</body>
</html>
