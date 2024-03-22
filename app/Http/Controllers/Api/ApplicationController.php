<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobApplyPosition;
use App\Models\JobApplySociety;
use App\Models\JobVacancy;
use App\Models\Society;
use App\Models\AvailablePosition;
use App\Models\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    public function index(Request $request)
{
    $society = Society::where('login_tokens', $request->token)->first();

    $application = JobApplySociety::where('society_id', $society->id)->first();

      if($application) {
        $vacancies = JobVacancy::where('id', $application->job_vacancy_id)->get();

        $vacancies->makeHidden('description');

           $vacancies->each(function ($vacancy) use ($application) {
            $vacancy->notes = $application->notes;
            $vacancy->date = $application->date;
        });
    } else {
             $vacancies = null;
    }

    return response()->json(compact('vacancies'), 200);
}


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vacancy_id' => 'required',
            'positions' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors(),
            ], 401);
        }
        $society = Society::where('login_tokens', $request->token)->first();

        $validation = Validation::where('society_id', $society->id)->first();

        if($validation->status != 'accepted') {
            return response()->json([
                'message' => 'Your data validation must be accepted by validator before',
            ], 401);
        }

        $application = JobApplySociety::where('society_id', $society->id)->first();

        if($application) {
            return response()->json([
                'message' => 'Application for a job can only be once'
            ], 401);
        }

        JobApplySociety::create([
            'notes' => $request->notes,
            'date' => date('Y-m-d'),
            'society_id' => $society->id,
            'job_vacancy_id' => $request->vacancy_id,
        ]);

        $job_apply_society = JobApplySociety::where('society_id', $society->id)->first();

        JobApplyPosition::create([
            'date' => date('Y-m-d'),
            'society_id' => $society->id,
            'job_vacancy_id' => $request->vacancy_id,
            'position_id' => $request->positions,
            'job_apply_societies_id' => $job_apply_society->id,
        ]);

        return response()->json([
            'message' => 'Applying for job successful',
        ], 200);
    }
}
