<?php

namespace App\Livewire;

use App\Models\Report;
use App\Models\ReportProgress;
use App\Models\ReportStage;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminReportView extends Component
{
    use WithFileUploads;

    public Report $report;

    public string $status = 'pending';

    public string $progressStage = '';

    public string $progressTitle = '';

    public string $progressNotes = '';

    public $progressPhoto;

    public ?string $progressDateTime = null;

    public ?int $editingProgressId = null;

    public string $editProgressStage = '';

    public string $editProgressTitle = '';

    public string $editProgressNotes = '';

    public ?string $editProgressedAt = null;

    public string $newStageLabel = '';

    /** @var array<string,string> */
    public array $stageOptions = [];

    public function mount(Report $report): void
    {
        $this->loadStageOptions();

        $this->report = $report->load(['user', 'attachments', 'progresses']);
        $this->status = (string) $this->report->status;
        $this->progressDateTime = now()->format('Y-m-d\TH:i');
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
            'progressDateTime' => ['nullable', 'date'],
        ], [], [
            'progressStage' => 'tahap progres',
            'progressTitle' => 'judul progres',
            'progressNotes' => 'catatan progres',
            'progressPhoto' => 'foto progres',
            'progressDateTime' => 'waktu progres',
        ]);

        $photoPath = null;

        if ($this->progressPhoto) {
            $photoPath = $this->progressPhoto->store('report-progress', 'public');
        }

        $progressedAt = $validated['progressDateTime']
            ? Carbon::parse($validated['progressDateTime'])
            : now();

        $this->report->progresses()->create([
            'stage' => $validated['progressStage'],
            'title' => $validated['progressTitle'],
            'notes' => $validated['progressNotes'] ?? null,
            'photo_path' => $photoPath,
            'progressed_at' => $progressedAt,
        ]);

        $this->reset(['progressTitle', 'progressNotes', 'progressPhoto']);
        $this->progressDateTime = now()->format('Y-m-d\TH:i');
        $this->report->load('progresses');

        $this->dispatch('progress-added');
    }

    public function startEditingProgress(int $progressId): void
    {
        $progress = $this->report->progresses()->find($progressId);

        if (! $progress) {
            return;
        }

        $this->editingProgressId = $progress->id;
        $this->editProgressStage = $progress->stage;
        $this->editProgressTitle = $progress->title;
        $this->editProgressNotes = $progress->notes ?? '';
        $this->editProgressedAt = optional($progress->progressed_at)->format('Y-m-d\TH:i');
    }

    public function cancelEditingProgress(): void
    {
        $this->resetEditState();
    }

    public function updateProgress(): void
    {
        if (! $this->editingProgressId) {
            return;
        }

        $progress = $this->report->progresses()->find($this->editingProgressId);

        if (! $progress) {
            $this->resetEditState();
            return;
        }

        $validated = $this->validate([
            'editProgressStage' => ['required', Rule::in(array_keys($this->stageOptions))],
            'editProgressTitle' => ['required', 'string', 'max:150'],
            'editProgressNotes' => ['nullable', 'string', 'max:2000'],
            'editProgressedAt' => ['nullable', 'date'],
        ], [], [
            'editProgressStage' => 'tahap progres',
            'editProgressTitle' => 'judul progres',
            'editProgressNotes' => 'catatan progres',
            'editProgressedAt' => 'waktu progres',
        ]);

        $progressedAt = $validated['editProgressedAt']
            ? Carbon::parse($validated['editProgressedAt'])
            : $progress->progressed_at;

        $progress->update([
            'stage' => $validated['editProgressStage'],
            'title' => $validated['editProgressTitle'],
            'notes' => $validated['editProgressNotes'] ?? null,
            'progressed_at' => $progressedAt,
        ]);

        $this->report->load('progresses');
        $this->resetEditState();

        $this->dispatch('progress-updated');
    }

    protected function resetEditState(): void
    {
        $this->editingProgressId = null;
        $this->editProgressStage = array_key_first($this->stageOptions) ?? '';
        $this->editProgressTitle = '';
        $this->editProgressNotes = '';
        $this->editProgressedAt = null;
    }

    public function createStage(): void
    {
        $validated = $this->validate([
            'newStageLabel' => ['required', 'string', 'max:100'],
        ], [], [
            'newStageLabel' => 'nama tahap',
        ]);

        $slug = Str::slug($validated['newStageLabel']);

        if (! $slug) {
            $this->addError('newStageLabel', 'Nama tahap tidak valid.');
            return;
        }

        if (ReportStage::where('slug', $slug)->exists()) {
            $this->addError('newStageLabel', 'Tahap dengan nama tersebut sudah ada.');
            return;
        }

        $order = (int) (ReportStage::max('sort_order') ?? 0) + 1;

        ReportStage::create([
            'slug' => $slug,
            'label' => trim($validated['newStageLabel']),
            'sort_order' => $order,
        ]);

        $this->newStageLabel = '';
        $this->loadStageOptions();
        $this->progressStage = $slug;
        $this->editProgressStage = $slug;
    }

    protected function loadStageOptions(): void
    {
        $this->stageOptions = ReportStage::orderedOptions();

        if ($this->stageOptions) {
            $firstKey = array_key_first($this->stageOptions);

            if (! $this->progressStage || ! array_key_exists($this->progressStage, $this->stageOptions)) {
                $this->progressStage = $firstKey;
            }

            if (! $this->editProgressStage || ! array_key_exists($this->editProgressStage, $this->stageOptions)) {
                $this->editProgressStage = $firstKey;
            }
        } else {
            $this->progressStage = '';
            $this->editProgressStage = '';
        }
    }

    public function render()
    {
        return view('livewire.admin-report-view')
            ->layout('components.layouts.app', [
                'title' => 'Detail Laporan',
            ]);
    }
}
