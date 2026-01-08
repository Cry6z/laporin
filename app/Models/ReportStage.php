<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'label',
        'sort_order',
    ];

    public static function orderedOptions(): array
    {
        return self::query()
            ->orderBy('sort_order')
            ->orderBy('label')
            ->pluck('label', 'slug')
            ->toArray();
    }
}
