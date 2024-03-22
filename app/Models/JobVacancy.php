<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];
    protected $hidden = [
        'job_category_id',
        // 'position',
    ];
    protected $appends = [
        'category',
        'available_position',
        // 'position',
    ];

    public function job_category()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function getCategoryAttribute()
    {
        $category = JobCategory::where('id', $this->job_category_id)->first();

        return $category;
    }

    public function getAvailablePositionAttribute()
    {
        $available_position = AvailablePosition::where('job_vacancy_id', $this->id)->get();

        return $available_position;
    }
}
