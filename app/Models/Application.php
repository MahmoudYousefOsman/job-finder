<?php

namespace App\Models;

use App\Enums\ApplicationStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Storage;

class Application extends Pivot
{
    use HasFactory;

    protected $table = 'applications';
    protected $fillable = [
        'job_id',
        'applicant_id',
        'resume',
        'status',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'status' => ApplicationStatusEnum::class,
        ];
    }

    protected function resumeUrl(): Attribute
    {
        return Attribute::get(fn () => Storage::url($this->resume));
    }
}
