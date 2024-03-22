<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplyPosition extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function society()
    {
        return $this->belongsTo(Society::class);
    }

    public function job_vacancy()
    {
        return $this->belongsTo(JobVacancy::class);
    }

    public function position()
    {
        return $this->belongsTo(AvailablePosition::class);
    }

    public function job_apply_societies()
    {
        return $this->belongsTo(JobApplySociety::class);
    }
}
