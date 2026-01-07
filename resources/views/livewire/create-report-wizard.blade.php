<div class="min-h-screen bg-gradient-to-b from-zinc-50 via-white to-zinc-50">
    <header class="border-b border-zinc-200 bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3 font-semibold" wire:navigate>
                <x-app-logo-icon class="h-9 w-9 fill-current text-zinc-900" />
                <span class="text-lg">Laporin</span>
            </a>

            <nav class="flex items-center gap-3">
                <a href="{{ route('my-reports') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100" wire:navigate>
                    Laporan Saya
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-lg px-3 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100">
                        Keluar
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
        <div class="mb-6 text-sm text-zinc-500">
            <a href="{{ route('home') }}" class="font-medium text-zinc-900" wire:navigate>Laporin</a>
            <span class="px-2">/</span>
            <span>Buat Aduan Baru</span>
        </div>

        <div class="mx-auto max-w-4xl">
            <div class="rounded-3xl border border-zinc-200/70 bg-white px-6 py-8 shadow-sm sm:px-8">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold tracking-tight text-zinc-900 sm:text-3xl">Buat Aduan Baru</h1>
                        <p class="mt-1 text-sm text-zinc-600">Isi data secara singkat dan jelas agar mudah ditindaklanjuti.</p>
                    </div>

                    <div class="text-xs text-zinc-500">
                        <span class="rounded-full border border-zinc-200 bg-zinc-50 px-3 py-1">Langkah {{ $step }} dari 3</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto mt-6 max-w-4xl">
            <div class="rounded-2xl border border-zinc-200/70 bg-white p-5 shadow-sm">
                <div class="relative">
                    <div class="absolute left-0 right-0 top-5 h-px bg-zinc-200"></div>
                    @php
                        $steps = [
                            1 => 'Aduan',
                            2 => 'Data Diri',
                            3 => 'Review',
                        ];
                    @endphp

                    <ol class="relative z-10 grid grid-cols-3 gap-2">
                        @foreach ($steps as $num => $label)
                            <li class="flex items-start justify-center">
                                <div class="flex flex-col items-center gap-2 text-center">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full border text-sm font-semibold
                                        {{ $step === $num ? 'border-brand-600 bg-brand-600 text-white' : ($step > $num ? 'border-brand-600 bg-white text-brand-700' : 'border-zinc-200 bg-white text-zinc-500') }}">
                                        @if ($step > $num)
                                            <span aria-hidden="true">✓</span>
                                        @else
                                            {{ $num }}
                                        @endif
                                    </div>
                                    <p class="text-sm font-semibold {{ $step >= $num ? 'text-zinc-900' : 'text-zinc-500' }}">{{ $label }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>

                <div class="mt-4 rounded-xl bg-zinc-50 px-4 py-3 text-sm text-zinc-600">
                    @if ($step === 1)
                        Tulis aduan dengan jelas, tambahkan lokasi, dan unggah foto jika diperlukan.
                    @elseif ($step === 2)
                        Data diri diambil dari akun yang sedang login.
                    @else
                        Cek kembali sebelum mengirim. Setelah dikirim, status bisa dipantau di halaman Laporan Saya.
                    @endif
                </div>
            </div>

            <div class="mt-6 grid gap-6 md:grid-cols-12">
                <div class="md:col-span-5">
                    <div class="flex h-full flex-col rounded-2xl border border-zinc-200/70 bg-white p-6 shadow-sm">
                        <h2 class="text-lg font-semibold tracking-tight text-zinc-900">
                        @if ($step === 1)
                            Informasi Aduan
                        @elseif ($step === 2)
                            Data Diri
                        @else
                            Review
                        @endif
                        </h2>
                        <p class="mt-2 text-sm leading-6 text-zinc-600">
                        @if ($step === 1)
                            Gunakan judul yang spesifik dan deskripsi yang mudah dipahami.
                        @elseif ($step === 2)
                            Pastikan akun yang digunakan adalah akun yang benar.
                        @else
                            Pastikan kategori, lokasi, dan lampiran sudah sesuai.
                        @endif
                        </p>

                        <div class="mt-5 space-y-4 text-sm text-zinc-700">
                            <div class="rounded-2xl border border-zinc-200 bg-zinc-50 p-5">
                                <p class="text-sm font-semibold text-zinc-900">Tips cepat</p>
                                <ul class="mt-3 space-y-2">
                                    <li class="flex items-start gap-2">
                                        <span class="mt-1 h-2 w-2 rounded-full bg-brand-600"></span>
                                        Judul singkat langsung ke inti masalah, maksimal 150 karakter.
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="mt-1 h-2 w-2 rounded-full bg-brand-600"></span>
                                        Sertakan lokasi jelas (jalan, RT/RW) agar tim lapangan mudah cek.
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="mt-1 h-2 w-2 rounded-full bg-brand-600"></span>
                                        Lampirkan 2–3 foto terbaik untuk mempercepat verifikasi.
                                    </li>
                                </ul>
                            </div>

                            <div class="rounded-2xl border border-dashed border-brand-200 bg-brand-50/60 p-5 text-sm text-brand-800">
                                <p class="font-semibold text-brand-900">Format deskripsi yang disarankan</p>
                                <ol class="mt-3 list-decimal space-y-1 pl-5 text-brand-800">
                                    <li>Kronologi singkat kapan kejadian berlangsung.</li>
                                    <li>Dampak yang dirasakan warga atau lingkungan.</li>
                                    <li>Harapan tindakan dari instansi terkait.</li>
                                </ol>
                            </div>

                            <div class="rounded-2xl border border-zinc-200 bg-white p-4 text-xs text-zinc-500">
                                Status laporan akan diperbarui melalui notif akun. Pastikan data diri di langkah berikutnya sesuai.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-7">
                    <div class="rounded-2xl border border-zinc-200/70 bg-white p-6 shadow-sm">
                    @if ($step === 1)
                        <div class="space-y-5">
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="grid gap-2 sm:col-span-2">
                                    <label class="text-sm font-medium text-zinc-900" for="title">Judul</label>
                                    <input id="title" type="text" wire:model.defer="title" class="h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600" placeholder="Contoh: Jalan berlubang di depan sekolah" />
                                    @error('title')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="grid gap-2">
                                    <label class="text-sm font-medium text-zinc-900" for="category">Kategori</label>
                                    <select id="category" wire:model.defer="category" class="h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600">
                                        <option value="">Pilih kategori</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat }}">{{ $cat }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="grid gap-2">
                                    <label class="text-sm font-medium text-zinc-900" for="priority">Prioritas</label>
                                    <select id="priority" wire:model.defer="priority" class="h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600">
                                        <option value="low">Rendah</option>
                                        <option value="normal">Normal</option>
                                        <option value="high">Tinggi</option>
                                    </select>
                                    @error('priority')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="grid gap-2 sm:col-span-2">
                                    <label class="text-sm font-medium text-zinc-900" for="location">Lokasi (opsional)</label>
                                    <input id="location" type="text" wire:model.defer="location" class="h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600" placeholder="Contoh: Jl. Merdeka, RT 02" />
                                    @error('location')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="grid gap-2 sm:col-span-2">
                                    <label class="text-sm font-medium text-zinc-900" for="description">Deskripsi</label>
                                    <textarea id="description" wire:model.defer="description" rows="6" class="w-full rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600" placeholder="Jelaskan kronologi dan detail masalah..."></textarea>
                                    @error('description')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid gap-2">
                                <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                    <label class="text-sm font-medium text-zinc-900" for="attachments">Lampiran Aduan</label>
                                    <span class="text-xs text-zinc-500">JPG/PNG, maks 5MB per file (maks 5 file)</span>
                                </div>

                                <label for="attachments" class="group relative flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-zinc-200 bg-zinc-50 px-4 py-7 text-center transition hover:border-zinc-300 hover:bg-zinc-100">
                                    <div class="text-sm font-semibold text-zinc-900">Klik untuk unggah</div>
                                    <div class="mt-1 text-xs text-zinc-500">atau tarik & lepas file ke area ini</div>
                                    <input id="attachments" type="file" wire:model="attachments" multiple accept="image/png,image/jpeg" class="hidden" />

                                    <div wire:loading wire:target="attachments" class="absolute inset-0 flex items-center justify-center rounded-2xl bg-white/70">
                                        <div class="rounded-xl border border-zinc-200 bg-white px-4 py-2 text-sm text-zinc-700">Mengunggah...</div>
                                    </div>
                                </label>

                                @error('attachments')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                @error('attachments.*')<p class="text-sm text-red-600">{{ $message }}</p>@enderror

                                @if ($attachments)
                                    <div class="grid grid-cols-2 gap-3 pt-2 sm:grid-cols-3">
                                        @foreach ($attachments as $i => $photo)
                                            <div class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-zinc-50">
                                                <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="h-28 w-full object-cover" />
                                                <button type="button" wire:click="removeAttachment({{ $i }})" class="absolute right-2 top-2 inline-flex h-8 w-8 items-center justify-center rounded-full bg-white/90 text-sm font-semibold text-zinc-700 shadow-sm ring-1 ring-zinc-200 hover:bg-white">
                                                    ×
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center justify-end">
                                <button type="button" wire:click="next" class="inline-flex h-11 items-center justify-center rounded-xl bg-brand-600 px-6 text-sm font-medium text-white shadow-sm hover:bg-brand-700">
                                    Selanjutnya
                                </button>
                            </div>
                        </div>
                    @elseif ($step === 2)
                        <div class="space-y-5">
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="grid gap-2 sm:col-span-2">
                                    <label class="text-sm font-medium text-zinc-900" for="reporter_name">Nama Lengkap</label>
                                    <input id="reporter_name" type="text" wire:model.defer="reporter_name" class="h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600" placeholder="Nama sesuai identitas" />
                                    @error('reporter_name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="grid gap-2 sm:col-span-2">
                                    <label class="text-sm font-medium text-zinc-900" for="reporter_email">Email</label>
                                    <input id="reporter_email" type="email" wire:model.defer="reporter_email" class="h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600" placeholder="email@contoh.com" />
                                    @error('reporter_email')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="grid gap-2">
                                    <label class="text-sm font-medium text-zinc-900" for="reporter_phone">Nomor WhatsApp (opsional)</label>
                                    <input id="reporter_phone" type="text" wire:model.defer="reporter_phone" class="h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600" placeholder="Contoh: 0812xxxx" />
                                    @error('reporter_phone')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="grid gap-2">
                                    <label class="text-sm font-medium text-zinc-900" for="reporter_address">Alamat (opsional)</label>
                                    <textarea id="reporter_address" wire:model.defer="reporter_address" rows="3" class="w-full rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600" placeholder="Alamat domisili terbaru"></textarea>
                                    @error('reporter_address')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="rounded-2xl border border-zinc-200 bg-zinc-50 p-5 text-sm text-zinc-600">
                                Pastikan kontak dapat dihubungi. Admin menggunakan data ini untuk klarifikasi laporan.
                            </div>

                            <div class="flex items-center justify-between">
                                <button type="button" wire:click="back" class="inline-flex h-11 items-center justify-center rounded-xl border border-zinc-200 bg-white px-6 text-sm font-medium text-zinc-900 hover:bg-zinc-50">
                                    Kembali
                                </button>
                                <button type="button" wire:click="next" class="inline-flex h-11 items-center justify-center rounded-xl bg-brand-600 px-6 text-sm font-medium text-white shadow-sm hover:bg-brand-700">
                                    Selanjutnya
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="space-y-4">
                            <div class="rounded-2xl border border-zinc-200 bg-white p-5">
                                <p class="text-xs font-medium text-zinc-500">Judul</p>
                                <p class="mt-1 text-sm font-semibold text-zinc-900">{{ $title ?: '-' }}</p>

                                <div class="mt-3 grid grid-cols-2 gap-3">
                                    <div>
                                        <p class="text-xs font-medium text-zinc-500">Kategori</p>
                                        <p class="mt-1 text-sm text-zinc-700">{{ $category ?: '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-zinc-500">Prioritas</p>
                                        <p class="mt-1 text-sm text-zinc-700">{{ $priority ?: '-' }}</p>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <p class="text-xs font-medium text-zinc-500">Lokasi</p>
                                    <p class="mt-1 text-sm text-zinc-700">{{ $location ?: '-' }}</p>
                                </div>

                                <div class="mt-3">
                                    <p class="text-xs font-medium text-zinc-500">Deskripsi</p>
                                    <p class="mt-1 whitespace-pre-line text-sm text-zinc-700">{{ $description ?: '-' }}</p>
                                </div>

                                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                                    <div>
                                        <p class="text-xs font-medium text-zinc-500">Nama Pelapor</p>
                                        <p class="mt-1 text-sm font-semibold text-zinc-900">{{ $reporter_name ?: '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-zinc-500">Email</p>
                                        <p class="mt-1 text-sm text-zinc-700">{{ $reporter_email ?: '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-zinc-500">Telepon</p>
                                        <p class="mt-1 text-sm text-zinc-700">{{ $reporter_phone ?: '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-zinc-500">Alamat</p>
                                        <p class="mt-1 text-sm text-zinc-700">{{ $reporter_address ?: '-' }}</p>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <p class="text-xs font-medium text-zinc-500">Lampiran</p>
                                    <p class="mt-1 text-sm text-zinc-700">{{ is_array($attachments) ? count($attachments) : 0 }} file</p>

                                    @if ($attachments)
                                        <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-3">
                                            @foreach ($attachments as $photo)
                                                <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-zinc-50">
                                                    <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="h-24 w-full object-cover" />
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <button type="button" wire:click="back" class="inline-flex h-11 items-center justify-center rounded-xl border border-zinc-200 bg-white px-6 text-sm font-medium text-zinc-900 hover:bg-zinc-50">
                                    Kembali
                                </button>
                                <button type="button" wire:click="submit" wire:loading.attr="disabled" class="inline-flex h-11 items-center justify-center rounded-xl bg-brand-600 px-6 text-sm font-medium text-white shadow-sm hover:bg-brand-700 disabled:opacity-60">
                                    <span wire:loading.remove>Kirim Laporan</span>
                                    <span wire:loading>Mengirim...</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
