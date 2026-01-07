@component('mail::message')
# Kode OTP Pendaftaran

Halo,

Gunakan kode berikut untuk menyelesaikan pendaftaran akun Laporin:

@component('mail::panel')
**{{ $otpCode }}**
@endcomponent

Kode ini berlaku selama 10 menit. Jika kamu tidak merasa melakukan pendaftaran, abaikan email ini.

Terima kasih,
**Tim Laporin**
@endcomponent
