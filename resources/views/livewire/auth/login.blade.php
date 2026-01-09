<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Masuk ke akun Anda')" :description="__('Masukkan email dan kata sandi Anda untuk masuk')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <div class="grid gap-2">
                <label for="email" class="text-sm font-medium text-zinc-900">{{ __('Alamat email') }}</label>
                <input
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="email@contoh.com"
                    class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600"
                />
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="relative">
                <div class="grid gap-2">
                    <label for="password" class="text-sm font-medium text-zinc-900">{{ __('Kata sandi') }}</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        placeholder="{{ __('Kata sandi') }}"
                        class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600"
                    />
                    @error('password')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                @if (Route::has('password.request'))
                    <a class="absolute top-0 end-0 text-sm font-medium text-zinc-700 hover:text-brand-700" href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Lupa kata sandi?') }}
                    </a>
                @endif
            </div>

            <!-- Remember Me -->
            <label class="flex items-center gap-2 text-sm text-zinc-700">
                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                    @checked(old('remember'))
                    class="h-4 w-4 rounded border-zinc-300 text-brand-600 focus:ring-brand-600"
                />
                <span>{{ __('Ingat saya') }}</span>
            </label>

            <div class="flex items-center justify-end">
                <button type="submit" class="inline-flex h-11 w-full items-center justify-center rounded-lg bg-brand-600 px-4 text-sm font-medium text-white shadow-sm hover:bg-brand-700" data-test="login-button">
                    {{ __('Masuk') }}
                </button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                <span>{{ __('Belum punya akun?') }}</span>
                <a class="font-medium text-brand-700 hover:underline" href="{{ route('register') }}" wire:navigate>{{ __('Daftar') }}</a>
            </div>
        @endif
    </div>
</x-layouts.auth>
