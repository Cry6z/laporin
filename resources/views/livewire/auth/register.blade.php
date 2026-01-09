<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Buat akun baru')" :description="__('Masukkan detail Anda untuk membuat akun')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.otp.request') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Name -->
            <div class="grid gap-2">
                <label for="name" class="text-sm font-medium text-zinc-900">{{ __('Nama lengkap') }}</label>
                <input
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="{{ __('Nama lengkap') }}"
                    class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600"
                />
                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="grid gap-2">
                <label for="email" class="text-sm font-medium text-zinc-900">{{ __('Alamat email') }}</label>
                <input
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="email@contoh.com"
                    class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600"
                />
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="grid gap-2">
                <label for="password" class="text-sm font-medium text-zinc-900">{{ __('Kata sandi') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="{{ __('Kata sandi') }}"
                    class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600"
                />
                @error('password')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="grid gap-2">
                <label for="password_confirmation" class="text-sm font-medium text-zinc-900">{{ __('Konfirmasi kata sandi') }}</label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="{{ __('Konfirmasi kata sandi') }}"
                    class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600"
                />
                @error('password_confirmation')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-3">
                <p class="text-sm text-zinc-500">Kami akan mengirim kode OTP ke email Anda untuk verifikasi sebelum akun aktif.</p>
                <button type="submit" class="inline-flex h-11 w-full items-center justify-center rounded-lg bg-brand-600 px-4 text-sm font-medium text-white shadow-sm hover:bg-brand-700" data-test="register-user-button">
                    {{ __('Kirim Kode OTP') }}
                </button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Sudah punya akun?') }}</span>
            <a class="font-medium text-brand-700 hover:underline" href="{{ route('login') }}" wire:navigate>{{ __('Masuk') }}</a>
        </div>
    </div>
</x-layouts.auth>
