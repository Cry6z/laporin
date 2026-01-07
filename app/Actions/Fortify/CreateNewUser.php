<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'email' => ['required', 'email'],
            'otp_code' => ['required', 'digits:6'],
        ])->validate();

        $otp = \App\Models\RegistrationOtp::where('email', $input['email'])->firstOrFail();

        if ($otp->otp_code !== $input['otp_code'] || $otp->expires_at->isPast()) {
            abort(422, 'OTP invalid');
        }

        $user = User::create([
            'name' => $otp->name,
            'email' => $otp->email,
            'role' => 'user',
            'password' => $otp->password_hash,
        ]);

        $otp->delete();

        return $user;
    }
}
