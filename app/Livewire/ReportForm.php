<?php

namespace App\Livewire;

use App\Models\Report;
use App\Models\ReportAttachment;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ReportForm extends Component
{
    use WithFileUploads;

    public string $title = '';

    public string $category = '';

    public string $description = '';

    public string $location = '';

    public string $priority = 'normal';

    public array $attachments = [];

    public function removeAttachment(int $index): void
    {
        if (! array_key_exists($index, $this->attachments)) {
            return;
        }

        unset($this->attachments[$index]);
        $this->attachments = array_values($this->attachments);
    }

    public function updatedAttachments(): void
    {
        if (count($this->attachments) > 5) {
            $this->attachments = array_slice($this->attachments, 0, 5);
            $this->addError('attachments', 'Maksimal 5 foto.');
        }

        $this->validateOnly('attachments');
        $this->validateOnly('attachments.*');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'category' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'priority' => ['nullable', 'in:low,normal,high'],
            'attachments' => ['nullable', 'array', 'max:5'],
            'attachments.*' => ['image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ];
    }

    public function submit()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $key = sprintf('report-submission:%s:%s', request()->ip(), auth()->id());

        if (RateLimiter::tooManyAttempts($key, 3)) {
            throw ValidationException::withMessages([
                'title' => 'Terlalu banyak pengiriman laporan. Coba lagi sebentar.',
            ]);
        }

        RateLimiter::hit($key, 60);

        $validated = $this->validate();

        $paths = [];

        foreach (($validated['attachments'] ?? []) as $file) {
            $paths[] = $file->storePublicly('reports', 'public');
        }

        $report = Report::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'location' => $validated['location'] ?: null,
            'priority' => $validated['priority'] ?: null,
            'attachment' => $paths[0] ?? null,
            'status' => 'pending',
            'waktu_pelaporan' => now(),
        ]);

        foreach ($paths as $path) {
            ReportAttachment::create([
                'report_id' => $report->id,
                'path' => $path,
            ]);
        }

        $this->reset(['title', 'category', 'description', 'location', 'priority', 'attachments']);
        $this->priority = 'normal';

        session()->flash('report_status', 'Laporan berhasil dikirim.');

        $this->dispatch('report-submitted');
    }

    public function render()
    {
        return view('livewire.report-form', [
            'categories' => [
                'Infrastruktur',
                'Kebersihan',
                'Keamanan',
                'Pelayanan Publik',
                'Lainnya',
            ],
        ]);
    }
}
