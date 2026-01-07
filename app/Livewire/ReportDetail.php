<?php

namespace App\Livewire;

use App\Models\Report;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class ReportDetail extends Component
{
    public Report $report;

    public function mount(Report $report): void
    {
        $this->report = $report->load(['attachments', 'user', 'progresses']);
    }

    public function render()
    {
        return view('livewire.report-detail')
            ->layout('components.layouts.public', [
                'title' => 'Detail Laporan · '.$this->report->title,
            ]);
    }
}
