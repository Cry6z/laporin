<x-layouts.public :title="$title ?? null">
    <div class="min-h-svh px-6 py-10">
        <div class="mx-auto w-full max-w-md">
            <a href="{{ route('home') }}" class="mb-8 flex items-center justify-center gap-3 font-semibold" wire:navigate>
                <x-app-logo-icon class="h-9 w-9 fill-current text-black" />
                <span class="text-lg">{{ config('app.name', 'Laporin') }}</span>
            </a>

            <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-layouts.public>
