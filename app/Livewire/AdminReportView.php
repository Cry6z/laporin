<?php

namespace App\Livewire;

use App\Models\Report;
use App\Models\ReportProgress;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminReportView extends Component
{
    use WithFileUploads;

    public Report $report;

    public string $status = 'pending';

    public string $progressStage = 'submitted';

    public string $progressTitle = '';

    public string $progressNotes = '';

    public $progressPhoto;

    /** @var array<string,string> */
    public array $stageOptions = [];

    public function mount(Report $report): void
    {
        $this->stageOptions = ReportProgress::stageOptions();

        $this->report = $report->load(['user', 'attachments', 'progresses']);
        $this->status = (string) $this->report->status;
    }

    public function updateStatus(): void
    {
        $validated = $this->validate([
            'status' => ['required', Rule::in(['pending', 'in_progress', 'resolved', 'rejected'])],
        ]);

        $resolvedAt = $this->report->resolved_at;

        if ($validated['status'] === 'resolved' && ! $resolvedAt) {
            $resolvedAt = now();
        }

        if ($validated['status'] !== 'resolved') {
            $resolvedAt = null;
        }

        $this->report->update([
            'status' => $validated['status'],
            'resolved_at' => $resolvedAt,
        ]);

        $this->dispatch('status-updated');
    }

    public function addProgress(): void
    {
        $validated = $this->validate([
            'progressStage' => ['required', Rule::in(array_keys($this->stageOptions))],
            'progressTitle' => ['required', 'string', 'max:150'],
            'progressNotes' => ['nullable', 'string', 'max:2000'],
            'progressPhoto' => ['nullable', 'image', 'max:3072'],
        ], [], [
            'progressStage' => 'tahap progres',
            'progressTitle' => 'judul progres',
            'progressNotes' => 'catatan progres',
            'progressPhoto' => 'foto progres',
        ]);

        $photoPath = null;

        if ($this->progressPhoto) {
            $photoPath = $this->progressPhoto->store('report-progress', 'public');
        }

        $this->report->progresses()->create([
            'stage' => $validated['progressStage'],
            'title' => $validated['progressTitle'],
            'notes' => $validated['progressNotes'] ?? null,
            'photo_path' => $photoPath,
            'progressed_at' => now(),
        ]);

        $this->reset(['progressTitle', 'progressNotes', 'progressPhoto']);
        $this->report->load('progresses');

        $this->dispatch('progress-added');
    }

    public function render()
    {
        return view('livewire.admin-report-view')
            ->layout('components.layouts.app', [
                'title' => 'Detail Laporan',
            ]);
    }
}
