<div class="flex h-full w-full flex-1 flex-col gap-6">
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Total</p>
            <p class="mt-1 text-2xl font-semibold text-neutral-900 dark:text-white">{{ $total }}</p>
        </div>
        <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Pending</p>
            <p class="mt-1 text-2xl font-semibold text-neutral-900 dark:text-white">{{ $pending }}</p>
        </div>
        <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
            <p class="text-sm text-neutral-600 dark:text-neutral-400">In Progress</p>
            <p class="mt-1 text-2xl font-semibold text-neutral-900 dark:text-white">{{ $inProgress }}</p>
        </div>
        <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Resolved</p>
            <p class="mt-1 text-2xl font-semibold text-neutral-900 dark:text-white">{{ $resolved }}</p>
        </div>
    </div>

    <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-900">
        <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-neutral-900 dark:text-white">Laporan Terbaru</h2>
                    <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">10 laporan terakhir yang masuk</p>
                </div>
                <a href="{{ route('admin.reports.index') }}" class="text-sm font-medium text-neutral-900 underline underline-offset-4 dark:text-white" wire:navigate>
                    Lihat semua
                </a>
            </div>
        </div>

        <div class="md:hidden">
            <div class="divide-y divide-neutral-200 dark:divide-neutral-800">
                @forelse ($recentReports as $report)
                    <div class="p-4">
                        <div class="flex items-center justify-between text-xs text-neutral-500">
                            <span>#{{ $report->id }}</span>
                            <span>{{ $report->waktu_pelaporan?->format('d M Y') }}</span>
                        </div>
                        <p class="mt-2 text-base font-semibold text-neutral-900 dark:text-white">{{ $report->title }}</p>
                        <p class="text-sm text-neutral-500">{{ $report->user?->name ?? 'Anonim' }}</p>
                        <div class="mt-3 flex items-center justify-between">
                            <span class="inline-flex items-center rounded-full border border-neutral-200 bg-neutral-50 px-3 py-1 text-xs font-medium capitalize text-neutral-700 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-200">
                                {{ str_replace('_', ' ', $report->status) }}
                            </span>
                            <a href="{{ route('admin.reports.show', $report) }}" class="text-sm font-semibold text-brand-600" wire:navigate>
                                Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="p-4 text-sm text-neutral-500">Belum ada laporan terbaru.</p>
                @endforelse
            </div>
        </div>

        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-neutral-200 text-sm dark:divide-neutral-700">
                <thead class="bg-neutral-50 dark:bg-neutral-800">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium text-neutral-600 dark:text-neutral-300">ID</th>
                        <th class="px-4 py-3 text-left font-medium text-neutral-600 dark:text-neutral-300">Judul</th>
                        <th class="px-4 py-3 text-left font-medium text-neutral-600 dark:text-neutral-300">Pelapor</th>
                        <th class="px-4 py-3 text-left font-medium text-neutral-600 dark:text-neutral-300">Status</th>
                        <th class="px-4 py-3 text-right font-medium text-neutral-600 dark:text-neutral-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse ($recentReports as $report)
                        <tr>
                            <td class="px-4 py-3 text-neutral-700 dark:text-neutral-200">#{{ $report->id }}</td>
                            <td class="px-4 py-3">
                                <p class="font-medium text-neutral-900 dark:text-white">{{ $report->title }}</p>
                                <p class="text-xs text-neutral-500">{{ $report->category }}</p>
                            </td>
                            <td class="px-4 py-3 text-neutral-700 dark:text-neutral-200">{{ $report->user?->name }}</td>
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
                            <td colspan="5" class="px-4 py-10 text-center text-sm text-neutral-600 dark:text-neutral-300">
                                Belum ada laporan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
