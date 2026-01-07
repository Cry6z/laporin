<div class="min-h-screen bg-gradient-to-b from-zinc-50 via-white to-zinc-50">
    <header class="border-b border-zinc-200 bg-white/95 backdrop-blur">
        <div class="mx-auto max-w-6xl px-4 py-4 sm:px-6">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 font-semibold text-zinc-900" wire:navigate>
                        <x-app-logo-icon class="h-9 w-9 fill-current text-brand-600" />
                        <div class="flex flex-col leading-tight">
                            <span class="text-base">Laporin</span>
                            <span class="text-xs font-normal text-zinc-500">Panel Pelapor</span>
                        </div>
                    </a>
                    <div class="flex items-center gap-3 rounded-xl border border-zinc-200 bg-white px-4 py-2 text-xs text-zinc-500 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l3 1.5M4.5 12a7.5 7.5 0 1 1 15 0 7.5 7.5 0 0 1-15 0z" />
                        </svg>
                        <div class="flex items-center gap-2 text-zinc-700" wire:poll.1s>
                            <span class="font-semibold text-zinc-900">Jam sekarang</span>
                            <span>{{ now()->timezone(config('app.timezone'))->format('H:i:s') }} WIB</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <nav class="flex flex-wrap items-center gap-2 text-sm font-medium text-zinc-700">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-xl border border-transparent px-4 py-2 hover:border-zinc-200 hover:bg-white" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75v9a1.5 1.5 0 0 1-1.5 1.5h-15A1.5 1.5 0 0 1 3 18.75v-9z" />
                            </svg>
                            Beranda
                        </a>
                        <a href="{{ route('my-reports') }}" class="inline-flex items-center gap-2 rounded-xl border border-transparent px-4 py-2 bg-zinc-900 text-white" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h10m-10 6h7" />
                            </svg>
                            Laporan Saya
                        </a>
                        <a href="{{ route('reports.create') }}" class="inline-flex items-center gap-2 rounded-xl border border-transparent px-4 py-2 hover:border-zinc-200 hover:bg-white" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                            Buat Laporan
                        </a>
                    </nav>

                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ route('reports.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-brand-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-brand-700" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                            Laporan Baru
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 rounded-xl border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M9 12h12m0 0-3-3m3 3-3 3" />
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-brand-600">Dashboard Aduan</p>
                <h1 class="mt-1 text-3xl font-semibold tracking-tight text-zinc-900">Laporan Saya</h1>
                <p class="mt-2 text-sm text-zinc-600">Pantau status laporan yang sudah kamu kirim dan cek progresnya setiap saat.</p>
            </div>
            <div class="flex gap-3">
                <button wire:click="$refresh" type="button" class="inline-flex h-11 items-center justify-center rounded-xl border border-zinc-200 bg-white px-4 text-sm font-medium text-zinc-900 shadow-sm hover:bg-zinc-50">
                    Segarkan
                </button>
                <a href="{{ route('reports.create') }}" class="inline-flex h-11 items-center justify-center rounded-xl bg-brand-600 px-5 text-sm font-medium text-white shadow-sm hover:bg-brand-700" wire:navigate>
                    Laporan Baru
                </a>
            </div>
        </div>

        @if (session('status'))
            <div class="mt-6 rounded-2xl border border-brand-200 bg-brand-50 px-4 py-3 text-sm text-brand-800">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-8 rounded-3xl border border-zinc-200/70 bg-white p-6 shadow-sm">
            <div class="hidden items-center justify-between border-b border-zinc-200 pb-4 text-xs font-medium uppercase tracking-wide text-zinc-500 sm:flex">
                <span class="w-2/5">Detail Laporan</span>
                <span class="w-1/5">Kategori & Waktu</span>
                <span class="w-1/5">Ringkasan</span>
                <span class="w-1/5 text-right">Status</span>
            </div>
            <div class="divide-y divide-zinc-100">
                @forelse ($reports as $report)
                    <div class="flex flex-col gap-4 py-6 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex w-full flex-col gap-4 sm:flex-row sm:items-center sm:gap-5 sm:w-2/5">
                            <div class="h-16 w-16 overflow-hidden rounded-2xl border border-zinc-200 bg-zinc-50">
                                @if ($report->attachment)
                                    <img src="{{ asset('storage/'.$report->attachment) }}" alt="Lampiran" class="h-full w-full object-cover" />
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-xs text-zinc-400">No Photo</div>
                                @endif
                            </div>
                            <div>
                                <p class="text-base font-semibold text-zinc-900">{{ $report->title }}</p>
                                <p class="mt-1 text-sm text-zinc-600">ID #{{ $report->id }}</p>
                            </div>
                        </div>

                        <div class="w-full text-sm text-zinc-600 sm:w-1/5">
                            <p class="font-medium text-zinc-900">{{ $report->category }}</p>
                            <p class="mt-1">{{ $report->waktu_pelaporan?->format('d M Y · H:i') }}</p>
                        </div>

                        <div class="w-full text-sm text-zinc-700 sm:w-1/5">
                            <p class="line-clamp-2">{{ $report->description }}</p>
                            @if ($report->attachment)
                                <a class="mt-2 inline-flex items-center gap-1 text-xs font-medium text-brand-700 hover:underline" href="{{ asset('storage/'.$report->attachment) }}" target="_blank">
                                    Lihat lampiran
                                </a>
                            @endif
                        </div>

                        <div class="flex w-full items-center justify-between sm:w-1/5 sm:justify-end">
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
                            <span class="inline-flex items-center rounded-full border px-4 py-1 text-xs font-semibold {{ $classes }}">{{ $label }}</span>
                        </div>
                    </div>
                @empty
                    <div class="p-10 text-center">
                        <p class="text-sm font-semibold text-zinc-900">Belum ada laporan</p>
                        <p class="mt-1 text-sm text-zinc-600">Mulai buat laporan pertama kamu agar bisa dipantau statusnya.</p>
                        <div class="mt-5">
                            <a href="{{ route('reports.create') }}" class="inline-flex h-10 items-center justify-center rounded-xl bg-brand-600 px-5 text-sm font-medium text-white shadow-sm hover:bg-brand-700" wire:navigate>
                                Buat Laporan
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="border-t border-zinc-200/70 bg-white p-4">
                {{ $reports->links() }}
            </div>
        </div>
    </main>
</div>
