<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];
    protected $hidden = [
        'society_id',
        'validator_id',
    ];

    public function job_category()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function society()
    {
        return $this->belongsTo(Society::class);
    }

    public function validator()
    {
        return $this->belongsTo(Validator::class);
    }
}
