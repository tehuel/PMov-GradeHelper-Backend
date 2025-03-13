<?php

namespace App\Models;

use App\Enums\GradeableType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Assessment extends Pivot
{
    use HasUuids;

    protected $table = 'assessments';

    public $timestamps = true;

    protected $fillable = ['due_at', 'grade_type'];

    protected function casts(): array
    {
        return [
            'due_at' => 'datetime',
            'grade_type' => GradeableType::class,
        ];
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'assessment_id')->latest();
    }
}
