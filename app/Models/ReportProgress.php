<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportProgress extends Model
{
    use HasFactory;

    protected $table = 'report_progresses';

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

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }
}
