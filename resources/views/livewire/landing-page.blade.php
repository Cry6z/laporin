<div class="min-h-screen bg-gradient-to-b from-zinc-50 via-white to-zinc-50">
    <style>
        html {
            scroll-behavior: smooth;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    <header class="border-b border-zinc-200 bg-white/90 backdrop-blur" x-data="{ menuOpen: false }" x-on:keydown.escape.window="menuOpen = false">
        <div class="mx-auto max-w-6xl px-4 py-4 sm:px-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex w-full items-center justify-between gap-3 sm:w-auto">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 font-semibold text-zinc-900" wire:navigate>
                        <x-app-logo-icon class="h-9 w-9 fill-current text-brand-600" />
                        <div class="flex flex-col leading-tight">
                            <span class="text-base">Laporin</span>
                        </div>
                    </a>

                    <button
                        type="button"
                        class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-zinc-200 bg-white text-zinc-700 shadow-sm transition hover:-translate-y-0.5 hover:bg-zinc-50 sm:hidden"
                        x-on:click="menuOpen = ! menuOpen"
                        :aria-expanded="menuOpen"
                        aria-controls="mobile-menu"
                    >
                        <svg x-show="!menuOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-cloak x-show="menuOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span class="sr-only">Toggle menu</span>
                    </button>
                </div>

                <nav class="hidden flex-1 items-center justify-center gap-2 text-sm font-medium text-zinc-700 sm:flex sm:px-6">
                    <a href="#cara" class="inline-flex items-center gap-2 rounded-xl border border-transparent px-4 py-2 hover:border-zinc-200 hover:bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l3 3" />
                        </svg>
                        Cara kerja
                    </a>
                    <a href="#faq" class="inline-flex items-center gap-2 rounded-xl border border-transparent px-4 py-2 hover:border-zinc-200 hover:bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75V12m0 3.75h.008v.008H12z" />
                        </svg>
                        FAQ
                    </a>
                    <a href="#reports" class="inline-flex items-center gap-2 rounded-xl border border-transparent px-4 py-2 hover:border-zinc-200 hover:bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 6.75h13.5m-13.5 5.25h9m-9 5.25h13.5" />
                        </svg>
                        Laporan terbaru
                    </a>
                </nav>

                <div class="hidden items-center gap-2 sm:flex sm:ms-auto">
                    @auth
                        <a href="{{ route('my-reports') }}" class="inline-flex items-center gap-2 rounded-xl border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-900 shadow-sm hover:bg-zinc-50" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 7.5l7-4.5 7 4.5v9l-7 4.5-7-4.5z" />
                            </svg>
                            Laporan Saya
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 rounded-xl border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M9 12h12m0 0-3-3m3 3-3 3" />
                                </svg>
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-900 shadow-sm hover:bg-zinc-50" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12h6m0 0-3 3m3-3-3-3M9 5.25h-1.5A2.25 2.25 0 0 0 5.25 7.5v9A2.25 2.25 0 0 0 7.5 18.75H9M9 5.25l6-2.25v15l-6 2.25M9 18.75v-13.5" />
                            </svg>
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-xl bg-brand-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-brand-700" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>

            <div
                id="mobile-menu"
                class="sm:hidden"
                x-cloak
                x-show="menuOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
            >
                <div class="mt-3 rounded-3xl border border-zinc-200 bg-white p-4 shadow-lg shadow-zinc-200/50">
                    <nav class="flex flex-col gap-2 text-sm font-semibold text-zinc-800">
                        <a href="#cara" class="inline-flex items-center justify-between rounded-2xl border border-zinc-100 px-4 py-3 text-zinc-700 hover:border-brand-200 hover:bg-brand-50/40" x-on:click="menuOpen = false">
                            Cara kerja
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        <a href="#faq" class="inline-flex items-center justify-between rounded-2xl border border-zinc-100 px-4 py-3 text-zinc-700 hover:border-brand-200 hover:bg-brand-50/40" x-on:click="menuOpen = false">
                            FAQ
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        <a href="#reports" class="inline-flex items-center justify-between rounded-2xl border border-zinc-100 px-4 py-3 text-zinc-700 hover:border-brand-200 hover:bg-brand-50/40" x-on:click="menuOpen = false">
                            Laporan terbaru
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </nav>

                    <div class="mt-4 rounded-2xl border border-dashed border-zinc-200 p-4">
                        @auth
                            <a href="{{ route('my-reports') }}" class="flex items-center justify-center gap-2 rounded-2xl border border-zinc-200 bg-white px-4 py-3 text-sm font-semibold text-zinc-900 shadow-sm hover:bg-zinc-50" wire:navigate x-on:click="menuOpen = false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 7.5l7-4.5 7 4.5v9l-7 4.5-7-4.5z" />
                                </svg>
                                Laporan Saya
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="mt-2" x-on:submit="menuOpen = false">
                                @csrf
                                <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-2xl border border-zinc-200 bg-white px-4 py-3 text-sm font-semibold text-zinc-700 hover:bg-zinc-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M9 12h12m0 0-3-3m3 3-3 3" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 rounded-2xl border border-zinc-200 bg-white px-4 py-3 text-sm font-semibold text-zinc-900 shadow-sm hover:bg-zinc-50" wire:navigate x-on:click="menuOpen = false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12h6m0 0-3 3m3-3-3-3M9 5.25h-1.5A2.25 2.25 0 0 0 5.25 7.5v9A2.25 2.25 0 0 0 7.5 18.75H9M9 5.25l6-2.25v15l-6 2.25M9 18.75v-13.5" />
                                </svg>
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="mt-2 flex items-center justify-center gap-2 rounded-2xl bg-brand-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-brand-700" wire:navigate x-on:click="menuOpen = false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                                Daftar
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

        </div>
    </header>

    <main>
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-b from-brand-50/30 via-white to-white"></div>
            <div class="relative mx-auto grid max-w-6xl grid-cols-1 items-center gap-12 px-4 py-16 sm:px-6 md:grid-cols-[1.05fr,0.95fr] md:py-24">
                <div class="text-center">
                    <h1 class="text-4xl font-semibold leading-tight text-zinc-900 sm:text-5xl sm:leading-tight">
                        Laporkan masalah di sekitarmu <span class="bg-gradient-to-r from-brand-500 to-emerald-500 bg-clip-text text-transparent">hanya dalam hitungan menit</span>.
                    </h1>
                    <p class="mt-4 max-w-2xl text-base leading-7 text-zinc-600 sm:text-lg mx-auto">
                        Lengkapi laporan dengan kategori, lokasi, serta foto bukti. Pantau progresnya langsung dari akunmu tanpa datang ke kantor.
                    </p>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center sm:items-center">
                        @auth
                            <a href="{{ route('reports.create') }}" class="inline-flex h-12 items-center justify-center rounded-2xl bg-brand-600 px-6 text-sm font-semibold text-white shadow-lg shadow-brand-500/30 transition hover:-translate-y-0.5 hover:bg-brand-700" wire:navigate>
                                Laporkan Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex h-12 items-center justify-center rounded-2xl bg-brand-600 px-6 text-sm font-semibold text-white shadow-lg shadow-brand-500/30 transition hover:-translate-y-0.5 hover:bg-brand-700" wire:navigate>
                                Login untuk Lapor
                            </a>
                        @endauth
                        <a href="#cara" class="inline-flex h-12 items-center justify-center rounded-2xl border border-zinc-200 bg-white px-6 text-sm font-semibold text-zinc-900 shadow-sm transition hover:-translate-y-0.5 hover:bg-zinc-50">
                            Lihat Cara Kerja
                        </a>
                    </div>

                    <div class="mt-6 h-px w-full bg-gradient-to-r from-transparent via-zinc-200 to-transparent"></div>
                </div>

            </div>
        </section>

        <section id="cara" class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
            <div class="rounded-3xl border border-zinc-200/80 bg-white p-8 shadow-sm">
                <div class="grid gap-10 md:grid-cols-[280px,1fr]">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-zinc-500">Cara kerja</p>
                        <h2 class="mt-2 text-3xl font-semibold tracking-tight text-zinc-900">3 langkah sederhana</h2>
                        <p class="mt-3 text-sm leading-6 text-zinc-600">Mulai dari isi form, unggah foto, hingga pantau status penyelesaian tanpa repot.</p>
                        <div class="mt-6 rounded-2xl bg-zinc-50 p-4 text-sm text-zinc-700">
                            <p class="font-semibold text-zinc-900">Tidak ada langkah yang dilompati.</p>
                            <p class="mt-1">Selesai isi form? Sistem langsung kirim ke admin dan kamu mendapat update otomatis.</p>
                        </div>
                    </div>
                    <div class="grid gap-4 md:grid-cols-3">
                        <div class="flex flex-col rounded-2xl border border-zinc-200 bg-white p-5">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-zinc-900 text-xs font-semibold text-white">01</span>
                            <p class="mt-4 text-base font-semibold text-zinc-900">Tulis laporan</p>
                            <p class="mt-2 text-sm text-zinc-600">Isi judul, kategori, deskripsi, lokasi, dan prioritas agar admin mudah memahami.</p>
                        </div>
                        <div class="flex flex-col rounded-2xl border border-zinc-200 bg-white p-5">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-brand-600 text-xs font-semibold text-white">02</span>
                            <p class="mt-4 text-base font-semibold text-zinc-900">Lampirkan bukti</p>
                            <p class="mt-2 text-sm text-zinc-600">Unggah hingga 5 foto (JPG/PNG) dan lihat preview-nya sebelum laporan dikirim.</p>
                        </div>
                        <div class="flex flex-col rounded-2xl border border-zinc-200 bg-white p-5">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-xs font-semibold text-white">03</span>
                            <p class="mt-4 text-base font-semibold text-zinc-900">Pantau status</p>
                            <p class="mt-2 text-sm text-zinc-600">Progres berubah dari pending → diproses → selesai. Kamu akan mendapat notifikasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="reports" class="mx-auto max-w-6xl px-4 pb-6 sm:px-6">
            <div class="flex flex-col gap-2 rounded-[32px] border border-zinc-200/80 bg-white/95 p-6 shadow-lg shadow-zinc-100 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-[0.3em] text-brand-500">Laporan</p>
                    <h2 class="mt-2 text-3xl font-semibold tracking-tight text-zinc-900">Laporan terbaru</h2>
                    <p class="mt-2 text-sm text-zinc-600">Beberapa laporan yang baru masuk untuk gambaran.</p>
                </div>

                @auth
                    <a href="{{ route('reports.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white shadow-md shadow-brand-500/30 transition hover:-translate-y-0.5 hover:bg-brand-700" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                        Buat Laporan
                    </a>
                @endauth
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-3">
                @forelse (($recentReports ?? []) as $report)
                    @php
                        $status = $report->status;
                        $map = [
                            'pending' => ['Menunggu', 'bg-amber-50 text-amber-700 border-amber-200'],
                            'in_progress' => ['Diproses', 'bg-brand-50 text-brand-700 border-brand-200'],
                            'resolved' => ['Selesai', 'bg-green-50 text-green-700 border-green-200'],
                            'rejected' => ['Ditolak', 'bg-red-50 text-red-700 border-red-200'],
                        ];
                        [$label, $classes] = $map[$status] ?? ['Unknown', 'bg-zinc-50 text-zinc-700 border-zinc-200'];
                    @endphp

                    <a href="{{ route('reports.show.public', $report) }}" class="group relative block rounded-[28px] border border-zinc-200/80 bg-white/95 p-6 shadow-sm ring-1 ring-transparent transition hover:-translate-y-1 hover:border-brand-200 hover:shadow-xl hover:ring-brand-100" wire:navigate>
                        <div class="flex items-start justify-between gap-3">
                            <p class="text-base font-semibold text-zinc-900 line-clamp-2">{{ $report->title }}</p>
                            <span class="shrink-0 inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium {{ $classes }}">{{ $label }}</span>
                        </div>
                        <p class="mt-2 text-xs font-semibold uppercase tracking-wide text-zinc-500">{{ $report->category }} · {{ $report->waktu_pelaporan?->format('d M Y') }}</p>
                        <p class="mt-3 line-clamp-3 text-sm text-zinc-700">{{ \Illuminate\Support\Str::limit($report->description, 130) }}</p>

                        @if ($report->attachment)
                            <div class="mt-5 overflow-hidden rounded-2xl border border-zinc-100 bg-zinc-50 shadow-inner">
                                <img src="{{ asset('storage/'.$report->attachment) }}" alt="Lampiran" class="h-40 w-full object-cover transition duration-300 group-hover:scale-[1.02]" loading="lazy" />
                            </div>
                        @else
                            <div class="mt-5 rounded-2xl border border-dashed border-zinc-200 bg-zinc-50/50 p-4 text-center text-sm text-zinc-500">
                                Tidak ada lampiran
                            </div>
                        @endif

                        <div class="mt-5 flex items-center justify-between border-t border-zinc-100 pt-4 text-sm font-semibold text-brand-700">
                            <span>Lihat detail laporan</span>
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-brand-50 text-brand-700 transition group-hover:bg-brand-600 group-hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 5 7 7-7 7" />
                                </svg>
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="rounded-[28px] border border-zinc-200 bg-white/90 p-8 text-center text-sm text-zinc-600 md:col-span-3">
                        Belum ada laporan.
                    </div>
                @endforelse
            </div>
        </section>

        <section id="faq" class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
            <div class="rounded-3xl border border-zinc-200/80 bg-white p-8 shadow-sm">
                <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-zinc-500">FAQ</p>
                        <h3 class="text-2xl font-semibold text-zinc-900">Pertanyaan yang sering diajukan</h3>
                        <p class="mt-2 text-sm text-zinc-600">Informasi singkat seputar proses pelaporan di Laporin.</p>
                    </div>
                    <a href="{{ route('reports.create') }}" class="inline-flex h-10 items-center justify-center rounded-xl border border-zinc-200 px-4 text-sm font-medium text-zinc-900 hover:bg-zinc-50" wire:navigate>
                        Kirim laporan
                    </a>
                </div>

                <div class="mt-8 space-y-4">
                    @php
                        $faqs = [
                            [
                                'question' => 'Apakah laporan bisa anonim?',
                                'answer' => 'Saat ini setiap laporan terhubung ke akun agar statusnya dapat dilacak dan diverifikasi.',
                            ],
                            [
                                'question' => 'Berapa maksimal foto yang dapat diunggah?',
                                'answer' => 'Kamu bisa menambahkan hingga 5 foto dalam format JPG atau PNG dengan ukuran maks 5MB per file.',
                            ],
                            [
                                'question' => 'Berapa lama laporan diproses?',
                                'answer' => 'Admin akan meninjau laporan dalam 1x24 jam kerja sebelum memberikan status “pending”, “diproses”, atau “selesai”.',
                            ],
                        ];
                    @endphp

                    @foreach ($faqs as $faq)
                        <details class="group rounded-2xl border border-zinc-200/80 bg-white px-5 py-4 shadow-sm transition open:shadow-md">
                            <summary class="flex cursor-pointer items-center justify-between gap-4 text-left">
                                <span class="text-base font-semibold text-zinc-900">{{ $faq['question'] }}</span>
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-zinc-200 text-xs font-semibold text-zinc-500 transition group-open:rotate-45">+</span>
                            </summary>
                            <p class="mt-3 text-sm leading-6 text-zinc-600">{{ $faq['answer'] }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-zinc-200 bg-white">
        <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6">
            <div class="flex flex-col gap-5 text-sm text-zinc-600 lg:flex-row lg:items-start lg:justify-between">
                <div class="max-w-lg space-y-3">
                    <p class="text-xl font-semibold text-zinc-900">Laporin</p>
                    <p class="text-base text-zinc-700">Sistem pengaduan publik untuk pelaporan yang tertib dan transparan.</p>
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.3em] text-zinc-500">Support</p>
                        <p class="text-sm text-zinc-600">Kami siap membantu Senin–Jumat pukul 08.00–17.00 WIB.</p>
                    </div>
                    <p class="text-xs text-zinc-500">Teruskan aspirasi publik dengan proses yang transparan dan terukur.</p>
                </div>

                <div class="flex flex-1 flex-col gap-4 lg:flex-row lg:justify-end">
                    <div class="flex-1 rounded-2xl border border-zinc-100 bg-zinc-50/70 p-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.35em] text-zinc-500">Kontak</p>
                        <div class="mt-3 flex flex-wrap gap-4 text-sm text-zinc-700">
                            <div>
                                <p class="text-[10px] uppercase tracking-wide text-zinc-500">WhatsApp (Aldi)</p>
                                <a href="https://wa.me/6281234567890" target="_blank" class="text-base font-semibold text-zinc-900 hover:text-brand-600">0812-3456-7890</a>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-wide text-zinc-500">WhatsApp (Gibran)</p>
                                <a href="https://wa.me/6281379669540" target="_blank" class="text-base font-semibold text-zinc-900 hover:text-brand-600">0813-7966-9540</a>
                            </div>
                            <div class="min-w-[200px]">
                                <p class="text-[10px] uppercase tracking-wide text-zinc-500">Email</p>
                                <a href="mailto:laporin.service@gmail.com" class="text-base font-semibold text-zinc-900 hover:text-brand-600 break-all">laporin.service@gmail.com</a>
                            </div>
                            <div class="min-w-[180px]">
                                <p class="text-[10px] uppercase tracking-wide text-zinc-500">Alamat</p>
                                <p class="text-base font-semibold text-zinc-900">Jl. Bali, Kampung Bali</p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full rounded-2xl border border-zinc-100 bg-white/80 p-4 lg:max-w-xs">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.35em] text-zinc-500">Jam Layanan</p>
                        <div class="mt-3 space-y-2 text-sm text-zinc-700">
                            <div>
                                <p class="text-base font-semibold text-zinc-900">Senin - Jumat</p>
                                <p>08.00 - 17.00 WIB</p>
                            </div>
                            <p class="text-xs text-zinc-500">Respon admin maksimal 1x24 jam kerja.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex flex-col gap-3 border-t border-dashed border-zinc-200 pt-6 text-xs text-zinc-500 sm:flex-row sm:items-center sm:justify-between">
                <p>© {{ now()->year }} Laporin. Semua hak dilindungi.</p>
                <div class="flex flex-wrap items-center gap-4">
                    <a href="#cara" class="hover:text-zinc-800">Kebijakan Privasi</a>
                    <span class="h-1 w-1 rounded-full bg-zinc-400"></span>
                    <a href="#faq" class="hover:text-zinc-800">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>
</div>
