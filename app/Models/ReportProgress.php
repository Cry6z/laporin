<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportProgress extends Model
{
    use HasFactory;

    protected $table = 'report_progresses';

    public const STAGE_OPTIONS = [
        'submitted' => 'Diajukan ke Pemerintah',
        'in_progress' => 'Sedang Proses',
        'completed' => 'Selesai Dikerjakan',
    ];

    protected $fillable = [
        'report_id',
        'stage',
        'title',
        'notes',
        'photo_path',
        'progressed_at',
    ];

    protected $casts = [
        'progressed_at' => 'datetime',
    ];

    public static function stageOptions(): array
    {
        return self::STAGE_OPTIONS;
    }

    public function stageLabel(): string
    {
        return self::STAGE_OPTIONS[$this->stage] ?? ucfirst(str_replace('_', ' ', $this->stage));
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }
}
