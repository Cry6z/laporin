<div class="flex h-full w-full flex-1 flex-col gap-4">
    <div class="rounded-3xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
        <div class="grid gap-6 md:grid-cols-[minmax(0,1fr),320px] md:items-start">
            <div>
                <div class="flex flex-wrap items-center gap-3 text-xs font-semibold uppercase tracking-[0.3em] text-neutral-500">
                    <span>Laporan #{{ $report->id }}</span>
                    <span class="inline-flex items-center rounded-full border border-neutral-200 px-3 py-1 text-[11px] font-medium uppercase tracking-wide text-neutral-500 dark:border-neutral-700 dark:text-neutral-300">
                        {{ $report->waktu_pelaporan?->format('d M Y H:i') }}
                    </span>
                </div>
                <h1 class="mt-3 text-3xl font-semibold text-neutral-900 dark:text-white">{{ $report->title }}</h1>
                <div class="mt-2 inline-flex items-center gap-2 rounded-full border border-brand-200 bg-brand-50/60 px-4 py-1 text-sm font-medium text-brand-800 dark:border-brand-400 dark:bg-brand-500/20">
                    {{ $report->category }}
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2">
                    <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50 p-4 dark:border-neutral-700 dark:bg-neutral-800">
                        <p class="text-xs font-semibold uppercase tracking-wide text-neutral-500">Deskripsi</p>
                        <p class="mt-2 text-sm text-neutral-800 dark:text-neutral-200 whitespace-pre-line">{{ $report->description }}</p>
                    </div>
                    <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50 p-4 dark:border-neutral-700 dark:bg-neutral-800">
                        <p class="text-xs font-semibold uppercase tracking-wide text-neutral-500">Lokasi</p>
                        <p class="mt-2 text-sm text-neutral-800 dark:text-neutral-200">{{ $report->location ?? 'Tidak diketahui' }}</p>
                        <p class="mt-4 text-xs font-semibold uppercase tracking-wide text-neutral-500">Prioritas</p>
                        <p class="mt-1 text-sm font-semibold text-neutral-900 dark:text-white">{{ ucfirst($report->priority ?? 'normal') }}</p>
                    </div>
                </div>
            </div>

            <form wire:submit="updateStatus" class="rounded-2xl border border-neutral-200 bg-neutral-50 p-5 shadow-inner dark:border-neutral-700 dark:bg-neutral-800">
                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-500">Status</p>
                <select wire:model.defer="status" class="mt-2 h-11 w-full rounded-xl border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-brand-500 dark:border-neutral-600 dark:bg-neutral-900 dark:text-white">
                    <option value="pending">pending</option>
                    <option value="in_progress">in_progress</option>
                    <option value="resolved">resolved</option>
                    <option value="rejected">rejected</option>
                </select>
                @error('status')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <button type="submit" class="mt-4 inline-flex h-11 w-full items-center justify-center rounded-xl bg-neutral-900 text-sm font-semibold text-white shadow-lg shadow-neutral-900/20 transition hover:-translate-y-0.5 hover:bg-neutral-800" wire:loading.attr="disabled">
                    <span wire:loading.remove>Simpan perubahan</span>
                    <span wire:loading>Menyimpan...</span>
                </button>

                <div class="mt-3 text-xs text-neutral-500">
                    @if ($report->resolved_at)
                        Diselesaikan pada {{ $report->resolved_at->format('d M Y H:i') }}
                    @else
                        Belum selesai
                    @endif
                </div>
            </form>
        </div>

        <div class="mt-8 grid gap-4 md:grid-cols-3">
            <div class="rounded-2xl border border-neutral-200 bg-neutral-50 p-5 dark:border-neutral-700 dark:bg-neutral-800">
                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-500">Pelapor</p>
                <dl class="mt-3 space-y-3 text-sm">
                    <div>
                        <dt class="text-xs text-neutral-500">Nama</dt>
                        <dd class="font-medium text-neutral-900 dark:text-white">{{ $report->reporter_name ?? $report->user?->name ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-neutral-500">Email</dt>
                        <dd>{{ $report->reporter_email ?? $report->user?->email ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-neutral-500">Telepon</dt>
                        <dd>{{ $report->reporter_phone ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-neutral-500">Alamat</dt>
                        <dd>{{ $report->reporter_address ?? '-' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="md:col-span-2 rounded-2xl border border-neutral-200 bg-neutral-50 p-5 dark:border-neutral-700 dark:bg-neutral-800">
                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-500">Lampiran</p>
                <div class="mt-3 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($report->attachments as $att)
                        <a href="{{ asset('storage/'.$att->path) }}" target="_blank" class="group overflow-hidden rounded-2xl border border-neutral-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg dark:border-neutral-700 dark:bg-neutral-900">
                            <img src="{{ asset('storage/'.$att->path) }}" alt="Attachment" class="h-28 w-full object-cover transition duration-300 group-hover:scale-[1.03]" />
                        </a>
                    @empty
                        <p class="text-sm text-neutral-600 dark:text-neutral-300">Tidak ada lampiran.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-3xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-neutral-900 dark:text-white">Alur Progres</h2>
                <p class="text-sm text-neutral-600 dark:text-neutral-300">Catat perkembangan pekerjaan lengkap dengan catatan dan foto pendukung.</p>
            </div>
        </div>

        <form wire:submit="addProgress" class="mt-4 grid gap-4 rounded-2xl border border-dashed border-neutral-200 bg-neutral-50 p-4 md:grid-cols-2 dark:border-neutral-700 dark:bg-neutral-800" enctype="multipart/form-data">
            <div>
                <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">Tahap</label>
                <select wire:model.defer="progressStage" class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white">
                    @foreach ($stageOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('progressStage')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">Judul Progres</label>
                <input type="text" wire:model.defer="progressTitle" class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white" placeholder="Contoh: Pembersihan lokasi" />
                @error('progressTitle')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:col-span-2">
                <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">Catatan</label>
                <textarea wire:model.defer="progressNotes" rows="3" class="mt-1 w-full rounded-lg border border-neutral-200 bg-white px-3 py-2 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white" placeholder="Detail kegiatan yang dilakukan..."></textarea>
                @error('progressNotes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">Foto Progres (opsional)</label>
                <input type="file" wire:model="progressPhoto" class="mt-1 block w-full text-sm text-neutral-600 file:me-3 file:rounded-lg file:border-0 file:bg-neutral-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-neutral-800" />
                @error('progressPhoto')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div wire:loading wire:target="progressPhoto" class="mt-1 text-xs text-neutral-500">Mengunggah foto...</div>
            </div>
            <div class="flex items-end justify-end">
                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-lg bg-neutral-900 px-4 text-sm font-medium text-white hover:bg-neutral-800" wire:loading.attr="disabled">
                    <span wire:loading.remove>Tambah Progres</span>
                    <span wire:loading>Memproses...</span>
                </button>
            </div>
        </form>

        <div class="mt-6 space-y-4">
            @php
                $stageLabels = $stageOptions ?? [];
            @endphp
            @forelse ($report->progresses as $progress)
                <div class="rounded-2xl border border-neutral-200 bg-neutral-50 p-4 dark:border-neutral-700 dark:bg-neutral-800">
                    <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-neutral-500">
                                {{ $stageLabels[$progress->stage] ?? ucfirst(str_replace('_', ' ', $progress->stage)) }}
                            </p>
                            <p class="text-base font-semibold text-neutral-900 dark:text-white">{{ $progress->title }}</p>
                        </div>
                        <p class="text-xs text-neutral-500">
                            {{ $progress->progressed_at?->format('d M Y · H:i') }}
                        </p>
                    </div>
                    @if ($progress->notes)
                        <p class="mt-3 text-sm text-neutral-700 dark:text-neutral-200">{{ $progress->notes }}</p>
                    @endif
                    @if ($progress->photo_path)
                        <a href="{{ asset('storage/'.$progress->photo_path) }}" target="_blank" class="mt-3 block overflow-hidden rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-900">
                            <img src="{{ asset('storage/'.$progress->photo_path) }}" alt="Foto progres" class="h-48 w-full object-cover" loading="lazy" />
                        </a>
                    @endif
                </div>
            @empty
                <p class="text-sm text-neutral-600 dark:text-neutral-300">Belum ada progres yang dicatat.</p>
            @endforelse
        </div>
    </div>

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.reports.index') }}" class="text-sm font-medium text-neutral-900 underline underline-offset-4 dark:text-white" wire:navigate>
            Kembali
        </a>

        <form method="POST" action="{{ route('admin.reports.export', $report) }}">
            @csrf
            <button type="submit" class="inline-flex h-10 items-center justify-center rounded-lg bg-neutral-900 px-4 text-sm font-medium text-white hover:bg-neutral-800">
                Export PDF
            </button>
        </form>
    </div>
</div>
