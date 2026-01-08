<div class="min-h-screen bg-gradient-to-b from-zinc-50 via-white to-zinc-50 py-10">
    <div class="mx-auto flex max-w-5xl flex-col gap-6 px-4 sm:px-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-brand-700" wire:navigate>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                Kembali
            </a>
            <span class="text-xs text-zinc-500">ID #{{ $report->id }}</span>
        </div>

        <div class="rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-wide text-zinc-500">Kategori {{ $report->category }}</p>
                    <h1 class="mt-2 text-3xl font-semibold text-zinc-900">{{ $report->title }}</h1>
                    <p class="mt-1 text-sm text-zinc-500">Dilaporkan pada {{ $report->waktu_pelaporan?->translatedFormat('d F Y · H:i') }}</p>
                </div>
                @php
                    $map = [
                        'pending' => ['Menunggu', 'bg-amber-50 text-amber-700 border-amber-200'],
                        'in_progress' => ['Diproses', 'bg-blue-50 text-blue-700 border-blue-200'],
                        'resolved' => ['Selesai', 'bg-emerald-50 text-emerald-700 border-emerald-200'],
                        'rejected' => ['Ditolak', 'bg-red-50 text-red-700 border-red-200'],
                    ];
                    [$label, $classes] = $map[$report->status] ?? ['Unknown', 'bg-zinc-50 text-zinc-700 border-zinc-200'];
                @endphp
                <span class="inline-flex items-center rounded-full border px-5 py-1 text-sm font-semibold {{ $classes }}">{{ $label }}</span>
            </div>

            <div class="mt-8 grid gap-8 md:grid-cols-[260px,1fr]">
                <div class="space-y-4">
                    <div class="rounded-2xl border border-zinc-200/70 bg-zinc-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Prioritas</p>
                        <p class="mt-1 text-lg font-semibold text-zinc-900">{{ ucfirst($report->priority ?? 'normal') }}</p>
                    </div>
                    <div class="rounded-2xl border border-zinc-200/70 bg-zinc-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Lokasi</p>
                        <p class="mt-1 text-sm text-zinc-800">{{ $report->location ?? 'Tidak diketahui' }}</p>
                    </div>
                    <div class="rounded-2xl border border-zinc-200/70 bg-zinc-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Pelapor</p>
                        <p class="mt-1 text-sm text-zinc-800">{{ $report->reporter_name ?? $report->user?->name ?? 'Anonim' }}</p>
                        @if ($report->reporter_email)
                            <p class="text-xs text-zinc-500">{{ $report->reporter_email }}</p>
                        @endif
                        @if ($report->reporter_phone)
                            <p class="text-xs text-zinc-500">{{ $report->reporter_phone }}</p>
                        @endif
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <p class="text-sm font-semibold text-zinc-900">Deskripsi</p>
                        <p class="mt-2 text-sm leading-relaxed text-zinc-700">{{ $report->description }}</p>
                    </div>

                    @if ($report->attachments->count() || $report->attachment)
                        <div>
                            <div class="hidden sm:block">
                                <p class="text-sm font-semibold text-zinc-900">Lampiran</p>
                                <div class="mt-3 grid gap-3 sm:grid-cols-2">
                                    @if ($report->attachment)
                                        <a href="{{ asset('storage/'.$report->attachment) }}" target="_blank" class="block overflow-hidden rounded-2xl border border-zinc-200">
                                            <img src="{{ asset('storage/'.$report->attachment) }}" alt="Lampiran" class="h-48 w-full object-cover" />
                                        </a>
                                    @endif
                                    @foreach ($report->attachments as $attachment)
                                        <a href="{{ asset('storage/'.$attachment->path) }}" target="_blank" class="block overflow-hidden rounded-2xl border border-zinc-200">
                                            <img src="{{ asset('storage/'.$attachment->path) }}" alt="Lampiran" class="h-48 w-full object-cover" />
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <div class="sm:hidden" x-data="{ openAttachment: false }">
                                <button
                                    type="button"
                                    class="flex w-full items-center justify-between rounded-2xl border border-zinc-200 bg-white px-4 py-3 text-left text-sm font-semibold text-zinc-900"
                                    x-on:click="openAttachment = ! openAttachment"
                                >
                                    Lampiran
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" :class="openAttachment ? 'rotate-180' : ''">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                                <div class="mt-3 grid gap-3" x-show="openAttachment" x-transition x-cloak>
                                    @if ($report->attachment)
                                        <a href="{{ asset('storage/'.$report->attachment) }}" target="_blank" class="block overflow-hidden rounded-2xl border border-zinc-200">
                                            <img src="{{ asset('storage/'.$report->attachment) }}" alt="Lampiran" class="h-40 w-full object-cover" />
                                        </a>
                                    @endif
                                    @foreach ($report->attachments as $attachment)
                                        <a href="{{ asset('storage/'.$attachment->path) }}" target="_blank" class="block overflow-hidden rounded-2xl border border-zinc-200">
                                            <img src="{{ asset('storage/'.$attachment->path) }}" alt="Lampiran" class="h-40 w-full object-cover" />
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($report->resolved_at)
                        <div class="rounded-2xl border border-emerald-200 bg-emerald-50/70 px-5 py-4 text-sm text-emerald-800">
                            Laporan diselesaikan pada {{ $report->resolved_at->translatedFormat('d F Y · H:i') }}.
                        </div>
                    @endif

                    <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-zinc-900">Proses</p>
                                <p class="text-xs text-zinc-500">Rangkaian tindakan yang dilakukan oleh instansi terkait.</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h13.5m-13.5 4.5h13.5M5.25 17.25h13.5" />
                            </svg>
                        </div>

                        @php
                            $stageLabels = \App\Models\ReportStage::orderedOptions();
                        @endphp

                        <div class="mt-6">
                            @if ($report->progresses->count())
                                <div class="relative pl-8">
                                    <div class="absolute left-4 top-0 h-full w-px bg-gradient-to-b from-brand-100 via-brand-100/60 to-transparent"></div>
                                    <div class="space-y-6">
                                        @foreach ($report->progresses as $progress)
                                            <div class="relative pl-6">
                                                <div class="absolute -left-10 top-2 flex items-center justify-center">
                                                    <span class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-brand-200 bg-white text-brand-600 shadow-sm">
                                                        <span class="h-2 w-2 rounded-full bg-brand-500"></span>
                                                    </span>
                                                </div>
                                                <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
                                                    <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                                        <div>
                                                            <p class="text-xs font-semibold uppercase tracking-wide text-brand-600">
                                                                {{ $stageLabels[$progress->stage] ?? ucfirst(str_replace('_', ' ', $progress->stage)) }}
                                                            </p>
                                                            <p class="text-lg font-semibold text-zinc-900">{{ $progress->title }}</p>
                                                        </div>
                                                        <p class="text-xs text-zinc-500">
                                                            {{ $progress->progressed_at?->translatedFormat('l, d F Y · H:i') }} WIB
                                                        </p>
                                                    </div>
                                                    @if ($progress->notes)
                                                        <p class="mt-3 text-sm leading-relaxed text-zinc-700">
                                                            {{ $progress->notes }}
                                                        </p>
                                                    @endif
                                                    @if ($progress->photo_path)
                                                        <a href="{{ asset('storage/'.$progress->photo_path) }}" target="_blank" class="mt-4 block overflow-hidden rounded-xl border border-zinc-200">
                                                            <img src="{{ asset('storage/'.$progress->photo_path) }}" alt="Foto progres" class="h-48 w-full object-cover" loading="lazy">
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="mt-6 rounded-2xl border border-dashed border-zinc-200 bg-zinc-50 px-5 py-4 text-sm text-zinc-500">
                                    Belum ada proses yang dicatat untuk laporan ini.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
