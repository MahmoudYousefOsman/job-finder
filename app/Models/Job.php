<?php

namespace App\Models;

use App\Enums\ExperienceLevelEnum;
use App\Enums\WorkTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobss';
    protected $fillable = [
        'title',
        'description',
        'responsibilities',
        'location',
        'salary_start',
        'salary_end',
        'work_type',
        'experience_leve',
        'category_id',
        'expired_at',
        'employer_id',
    ];

    public function isExpired(): bool
    {
        return now()->greaterThan($this->expired_at);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function employer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'job_id');
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class, 'job_id');
    }

    public function applicants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'applications', 'job_id', 'applicant_id')
            ->using(Application::class)->withPivot(['resume','status','id'])
            ;
    }

    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
            'experience_leve' => ExperienceLevelEnum::class,
            'work_type' => WorkTypeEnum::class,
        ];
    }

}
