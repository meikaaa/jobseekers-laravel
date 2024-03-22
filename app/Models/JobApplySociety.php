<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplySociety extends Model
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
}
