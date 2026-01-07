<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Mail\RegistrationOtpMail;
use App\Models\RegistrationOtp;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegistrationOtpController extends Controller
{
    use PasswordValidationRules;

    public function showOtpForm(Request $request): View|RedirectResponse
    {
        $email = session('registration_email');

        if (! $email) {
            return redirect()->route('register');
        }

        return view('livewire.auth.register-otp', [
            'email' => $email,
        ]);
    }

    public function requestOtp(Request $request): RedirectResponse
    {
        $input = $request->all();

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'password_confirmation' => ['required', 'same:password'],
        ])->validate();

        $otpCode = (string) random_int(100000, 999999);

        RegistrationOtp::updateOrCreate(
            ['email' => $input['email']],
            [
                'name' => $input['name'],
                'password_hash' => Hash::make($input['password']),
                'otp_code' => $otpCode,
                'expires_at' => now()->addMinutes(10),
                'attempts' => 0,
            ],
        );

        Mail::to($input['email'])->send(new RegistrationOtpMail($otpCode));
        session(['registration_email' => $input['email']]);

        return redirect()
            ->route('register.otp.form')
            ->with('status', 'Kode OTP sudah dikirim ke email. Berlaku 10 menit.');
    }

    public function verifyOtp(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'otp_code' => ['required', 'digits:6'],
        ]);

        $otp = RegistrationOtp::where('email', $data['email'])->first();

        if (! $otp) {
            return redirect()->route('register')->withErrors(['email' => 'OTP tidak ditemukan.']);
        }

        if ($otp->expires_at->isPast()) {
            $otp->delete();

            return back()->withErrors(['otp_code' => 'Kode OTP kedaluwarsa. Silakan minta ulang.']);
        }

        if ($otp->attempts >= 5) {
            $otp->delete();

            return back()->withErrors(['otp_code' => 'Percobaan OTP terlalu banyak. Silakan daftar ulang.']);
        }

        if ($otp->otp_code !== $data['otp_code']) {
            $otp->increment('attempts');

            return back()->withErrors(['otp_code' => 'Kode OTP salah.']);
        }

        $user = User::create([
            'name' => $otp->name,
            'email' => $otp->email,
            'role' => 'user',
            'password' => $otp->password_hash,
        ]);

        event(new Registered($user));
        Auth::login($user);
        $otp->delete();
        session()->forget('registration_email');

        return redirect()->route('home');
    }
}
