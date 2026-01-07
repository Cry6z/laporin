<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reporter_name',
        'reporter_email',
        'reporter_phone',
        'reporter_address',
        'title',
        'category',
        'description',
        'attachment',
        'location',
        'status',
        'priority',
        'waktu_pelaporan',
        'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'waktu_pelaporan' => 'datetime',
            'resolved_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(ReportAttachment::class);
    }

    public function progresses(): HasMany
    {
        return $this->hasMany(ReportProgress::class)->latest('progressed_at');
    }
}
