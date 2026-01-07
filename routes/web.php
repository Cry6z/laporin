<?php

use App\Http\Controllers\Auth\RegistrationOtpController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\ReportExportController;
use App\Livewire\AdminDashboard;
use App\Livewire\AdminReports;
use App\Livewire\AdminReportView;
use App\Livewire\CreateReportWizard;
use App\Livewire\LandingPage;
use App\Livewire\MyReports;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', LandingPage::class)->name('home');

Route::post('/register/request-otp', [RegistrationOtpController::class, 'requestOtp'])
    ->name('register.otp.request');

Route::get('/register/otp', [RegistrationOtpController::class, 'showOtpForm'])
    ->name('register.otp.form');

Route::post('/register/otp', [RegistrationOtpController::class, 'verifyOtp'])
    ->name('register.otp.verify');

Route::post('/report', [ReportController::class, 'store'])
    ->middleware(['auth', 'throttle:report-submit'])
    ->name('report.store');

Route::get('/reports/{report}', \App\Livewire\ReportDetail::class)
    ->name('reports.show.public');

Route::get('/my-reports', MyReports::class)
    ->middleware(['auth'])
    ->name('my-reports');

Route::get('/reports/create', CreateReportWizard::class)
    ->middleware(['auth'])
    ->name('reports.create');

Route::get('/dashboard', function () {
    return auth()->user()?->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('my-reports');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/', AdminDashboard::class)->name('dashboard');
    Route::get('/reports', AdminReports::class)->name('reports.index');
    Route::get('/reports/{report}', AdminReportView::class)->name('reports.show');
    Route::post('/reports/{report}/export', ReportExportController::class)->name('reports.export');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
