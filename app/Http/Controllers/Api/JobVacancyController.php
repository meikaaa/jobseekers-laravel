<?php

namespace App\Http\Controllers\Api;

use App\Models\Society;
use App\Models\JobVacancy;
use App\Models\Validation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobVacancyController extends Controller
{
    public function index(Request $request)
    {
        $society = Society::where('login_tokens', $request->token)->first();
        $validation = Validation::where('society_id', $society->id)->first();
        $vacancies = JobVacancy::where('job_category_id', $validation->job_category_id)->get();

        return response()->json(compact('vacancies'), 200);
    }

    public function show(Request $request, JobVacancy $job_vacancy)
    {
        $vacancy = $job_vacancy;

        return response()->json(compact('vacancy'), 200);
    }
}
