<?php

namespace App\Livewire;

use App\Models\Report;
use Livewire\Component;

class LandingPage extends Component
{
    public function render()
    {
        $reports = Report::query()
            ->with('attachments')
            ->latest('waktu_pelaporan')
            ->take(6)
            ->get();

        return view('livewire.landing-page', [
            'recentReports' => $reports,
        ])
            ->layout('components.layouts.public', [
                'title' => 'Laporin',
            ]);
    }
}
