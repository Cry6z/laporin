<div class="flex h-full w-full flex-1 flex-col gap-4">
    <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
        <div class="grid gap-3 md:grid-cols-5">
            <div class="md:col-span-2">
                <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">Search</label>
                <input type="text" wire:model.live.debounce.300ms="search" class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white" placeholder="Judul / deskripsi / pelapor" />
            </div>

            <div>
                <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">Status</label>
                <select wire:model.live="status" class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white">
                    <option value="">Semua</option>
                    <option value="pending">pending</option>
                    <option value="in_progress">in_progress</option>
                    <option value="resolved">resolved</option>
                    <option value="rejected">rejected</option>
                </select>
            </div>

            <div>
                <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">Kategori</label>
                <select wire:model.live="category" class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white">
                    <option value="">Semua</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-3 md:col-span-5 md:max-w-md">
                <div>
                    <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">Dari</label>
                    <input type="date" wire:model.live="dateFrom" class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white" />
                </div>
                <div>
                    <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">Sampai</label>
                    <input type="date" wire:model.live="dateTo" class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white" />
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-900">
        <div class="md:hidden divide-y divide-neutral-200 dark:divide-neutral-800">
            @forelse ($reports as $report)
                <div class="p-4 space-y-3">
                    <div class="flex items-center justify-between text-xs text-neutral-500 dark:text-neutral-400">
                        <span class="font-semibold text-neutral-900 dark:text-white">#{{ $report->id }}</span>
                        <span>{{ $report->waktu_pelaporan?->format('d M Y') }}</span>
                    </div>
                    <div>
                        <p class="text-base font-semibold text-neutral-900 dark:text-white">{{ $report->title }}</p>
                        <p class="text-xs uppercase tracking-wide text-neutral-500">{{ $report->category }}</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2 text-sm text-neutral-500 dark:text-neutral-300">
                        <span class="inline-flex items-center gap-2 rounded-full border border-neutral-200 bg-neutral-50 px-3 py-1 text-xs font-medium text-neutral-700 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-100">
                            {{ str_replace('_', ' ', $report->status) }}
                        </span>
                        <span>• {{ $report->user?->name ?? 'Anonim' }}</span>
                    </div>
                    <div class="flex justify-end">
                        <a href="{{ route('admin.reports.show', $report) }}" class="text-sm font-semibold text-brand-600" wire:navigate>
                            Detail
                        </a>
                    </div>
                </div>
            @empty
                <p class="p-4 text-center text-sm text-neutral-500 dark:text-neutral-300">
                    Tidak ada data.
                </p>
            @endforelse
        </div>

        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-neutral-200 text-sm dark:divide-neutral-700">
                <thead class="bg-neutral-50 dark:bg-neutral-800">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium text-neutral-600 dark:text-neutral-300">ID</th>
                        <th class="px-4 py-3 text-left font-medium text-neutral-600 dark:text-neutral-300">Judul</th>
                        <th class="px-4 py-3 text-left font-medium text-neutral-600 dark:text-neutral-300">Pelapor</th>
                        <th class="px-4 py-3 text-left font-medium text-neutral-600 dark:text-neutral-300">Tanggal</th>
                        <th class="px-4 py-3 text-left font-medium text-neutral-600 dark:text-neutral-300">Status</th>
                        <th class="px-4 py-3 text-right font-medium text-neutral-600 dark:text-neutral-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse ($reports as $report)
                        <tr>
                            <td class="px-4 py-3 text-neutral-700 dark:text-neutral-200">#{{ $report->id }}</td>
                            <td class="px-4 py-3">
                                <p class="font-medium text-neutral-900 dark:text-white">{{ $report->title }}</p>
                                <p class="text-xs text-neutral-500">{{ $report->category }}</p>
                            </td>
                            <td class="px-4 py-3 text-neutral-700 dark:text-neutral-200">{{ $report->user?->name }}</td>
                            <td class="px-4 py-3 text-neutral-700 dark:text-neutral-200">{{ $report->waktu_pelaporan?->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full border border-neutral-200 bg-neutral-50 px-2 py-1 text-xs font-medium text-neutral-700 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-200">
                                    {{ $report->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.reports.show', $report) }}" class="text-sm font-medium text-neutral-900 underline underline-offset-4 dark:text-white" wire:navigate>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-sm text-neutral-600 dark:text-neutral-300">
                                Tidak ada data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
            {{ $reports->links() }}
        </div>
    </div>
</div>
