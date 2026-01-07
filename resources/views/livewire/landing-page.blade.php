<div class="min-h-screen bg-gradient-to-b from-zinc-50 via-white to-zinc-50">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
    <header class="border-b border-zinc-200 bg-white/90 backdrop-blur">
        <div class="mx-auto max-w-6xl px-4 py-4 sm:px-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-3 font-semibold text-zinc-900" wire:navigate>
                    <x-app-logo-icon class="h-9 w-9 fill-current text-brand-600" />
                    <div class="flex flex-col leading-tight">
                        <span class="text-base">Laporin</span>
                    </div>
                </a>

                <nav class="flex flex-wrap items-center gap-2 text-sm font-medium text-zinc-700 sm:flex-1 sm:justify-center sm:px-6">
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

                <div class="flex items-center gap-2 sm:ms-auto">
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

                <dl class="mt-8 divide-y divide-zinc-200">
                    <div class="flex flex-col gap-2 py-6 md:flex-row md:items-start md:gap-6">
                        <dt class="text-sm font-semibold text-zinc-900 md:w-1/3">Apakah laporan bisa anonim?</dt>
                        <dd class="text-sm text-zinc-600 md:flex-1">Saat ini setiap laporan terhubung ke akun agar statusnya dapat dilacak dan diverifikasi.</dd>
                    </div>
                    <div class="flex flex-col gap-2 py-6 md:flex-row md:items-start md:gap-6">
                        <dt class="text-sm font-semibold text-zinc-900 md:w-1/3">Berapa maksimal foto yang dapat diunggah?</dt>
                        <dd class="text-sm text-zinc-600 md:flex-1">Kamu bisa menambahkan hingga 5 foto dalam format JPG atau PNG dengan ukuran maks 5MB per file.</dd>
                    </div>
                    <div class="flex flex-col gap-2 py-6 md:flex-row md:items-start md:gap-6">
                        <dt class="text-sm font-semibold text-zinc-900 md:w-1/3">Berapa lama laporan diproses?</dt>
                        <dd class="text-sm text-zinc-600 md:flex-1">Admin akan meninjau laporan dalam 1x24 jam kerja sebelum memberikan status “pending”, “diproses”, atau “selesai”.</dd>
                    </div>
                </dl>
            </div>
        </section>
    </main>

    <footer class="border-t border-zinc-200 bg-white">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
            <div class="grid gap-8 text-sm text-zinc-600 sm:grid-cols-2 lg:grid-cols-4">
                <div class="space-y-2">
                    <p class="text-lg font-semibold text-zinc-900">Laporin</p>
                    <p>Sistem pengaduan publik untuk pelaporan yang tertib dan transparan.</p>
                    <p class="text-xs text-zinc-500">  {{ date('Y') }} Laporin</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Navigasi</p>
                    <ul class="mt-3 space-y-2">
                        <li><a wire:navigate href="{{ route('home') }}" class="hover:text-zinc-900">Beranda</a></li>
                        <li><a wire:navigate href="#cara" class="hover:text-zinc-900">Cara Kerja</a></li>
                        @auth
                            <li><a wire:navigate href="{{ route('reports.create') }}" class="hover:text-zinc-900">Buat Laporan</a></li>
                            <li><a wire:navigate href="{{ route('my-reports') }}" class="hover:text-zinc-900">Laporan Saya</a></li>
                        @else
                            <li><a wire:navigate href="{{ route('login') }}" class="hover:text-zinc-900">Masuk</a></li>
                            <li><a wire:navigate href="{{ route('register') }}" class="hover:text-zinc-900">Daftar</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Kontak</p>
                    <ul class="mt-3 space-y-2">
                        <li>WhatsApp: <span class="font-medium text-zinc-900">0812-3456-7890</span></li>
                        <li>Email: <a href="mailto:halo@laporin.id" class="font-medium text-zinc-900 hover:underline">halo@laporin.id</a></li>
                        <li>Alamat: Jl. Merdeka No. 1, Jakarta</li>
                    </ul>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Jam Layanan</p>
                    <p class="mt-3 text-sm text-zinc-600">Senin - Jumat<br>08.00 - 17.00 WIB</p>
                    <p class="mt-3 text-xs text-zinc-500">Respon admin maksimal 1x24 jam kerja.</p>
                </div>
            </div>
        </div>
    </footer>
</div>
