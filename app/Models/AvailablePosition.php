<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailablePosition extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];
    protected $hidden = [
        'id',
        'job_vacancy_id',
    ];
    protected $appends = [
        'apply_count',
    ];

    public function job_vacancy()
    {
        return $this->belongsTo(JobVacancy::class);
    }

    public function getApplyCountAttribute()
    {
        $apply_count = JobApplySociety::where('job_vacancy_id', $this->job_vacancy_id)->count();

        return $apply_count;
    }
}
