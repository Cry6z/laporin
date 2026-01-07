<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Verifikasi Email')" :description="__('Masukkan kode OTP yang dikirim ke email kamu')" />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.otp.verify') }}" class="flex flex-col gap-6">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}" />

            <div class="grid gap-2">
                <label class="text-sm font-medium text-zinc-900">Email</label>
                <input value="{{ $email }}" type="email" disabled class="h-11 w-full rounded-lg border border-zinc-200 bg-zinc-50 px-3 text-sm text-zinc-500" />
            </div>

            <div class="grid gap-2">
                <label for="otp_code" class="text-sm font-medium text-zinc-900">Kode OTP</label>
                <input
                    id="otp_code"
                    name="otp_code"
                    type="text"
                    maxlength="6"
                    inputmode="numeric"
                    pattern="[0-9]{6}"
                    required
                    class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-center text-lg tracking-[0.4em] text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600"
                    placeholder="000000"
                />
                @error('otp_code')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="inline-flex h-11 w-full items-center justify-center rounded-lg bg-brand-600 px-4 text-sm font-medium text-white shadow-sm hover:bg-brand-700">
                Verifikasi &amp; Buat Akun
            </button>
        </form>

        <div class="text-center text-sm text-zinc-600">
            <p>Belum menerima kode? <a href="{{ route('register') }}" class="font-semibold text-brand-700 hover:underline">Kirim ulang OTP</a></p>
        </div>
    </div>
</x-layouts.auth>
