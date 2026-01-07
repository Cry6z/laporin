<?php

namespace App\Livewire;

use App\Models\Report;
use App\Models\ReportAttachment;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreateReportWizard extends Component
{
    use WithFileUploads;

    public int $step = 1;

    public string $title = '';

    public string $category = '';

    public string $description = '';

    public string $location = '';

    public string $priority = 'normal';

    public array $attachments = [];

    public string $reporter_name = '';

    public string $reporter_email = '';

    public string $reporter_phone = '';

    public string $reporter_address = '';

    public function mount(): void
    {
        $user = auth()->user();

        if ($user) {
            $this->reporter_name = (string) $user->name;
            $this->reporter_email = (string) $user->email;
        }
    }

    public function removeAttachment(int $index): void
    {
        if (! array_key_exists($index, $this->attachments)) {
            return;
        }

        unset($this->attachments[$index]);
        $this->attachments = array_values($this->attachments);
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
            'reporter_name' => ['required', 'string', 'max:150'],
            'reporter_email' => ['required', 'email', 'max:150'],
            'reporter_phone' => ['nullable', 'string', 'max:30'],
            'reporter_address' => ['nullable', 'string', 'max:255'],
        ];
    }

    protected function stepRules(int $step): array
    {
        return match ($step) {
            1 => [
                'title' => $this->rules()['title'],
                'category' => $this->rules()['category'],
                'description' => $this->rules()['description'],
                'location' => $this->rules()['location'],
                'priority' => $this->rules()['priority'],
                'attachments' => $this->rules()['attachments'],
                'attachments.*' => $this->rules()['attachments.*'],
            ],
            2 => [
                'reporter_name' => $this->rules()['reporter_name'],
                'reporter_email' => $this->rules()['reporter_email'],
                'reporter_phone' => $this->rules()['reporter_phone'],
                'reporter_address' => $this->rules()['reporter_address'],
            ],
            default => [],
        };
    }

    public function next(): void
    {
        $rules = $this->stepRules($this->step);

        if (! empty($rules)) {
            $this->validate($rules);
        }

        $this->step = min(3, $this->step + 1);
    }

    public function back(): void
    {
        $this->step = max(1, $this->step - 1);
    }

    public function submit()
    {
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
            'reporter_name' => $validated['reporter_name'],
            'reporter_email' => $validated['reporter_email'],
            'reporter_phone' => $validated['reporter_phone'] ?: null,
            'reporter_address' => $validated['reporter_address'] ?: null,
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

        return redirect()
            ->route('my-reports')
            ->with('status', 'Laporan berhasil dikirim.');
    }

    public function render()
    {
        return view('livewire.create-report-wizard', [
            'categories' => [
                'Infrastruktur',
                'Kebersihan',
                'Keamanan',
                'Pelayanan Publik',
                'Lainnya',
            ],
        ])->layout('components.layouts.public', [
            'title' => 'Buat Aduan Baru',
        ]);
    }
}
