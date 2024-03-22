<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Society;
use App\Models\Validation;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function index(Request $request)
    {
        $society = Society::where('login_tokens', $request->token)->first();

        $validation = Validation::where('society_id', $society->id)->with('validator', 'job_category')->first();

        return response()->json(compact('validation'), 200);
    }

    public function store(Request $request)
    {
        $society = Society::where('login_tokens', $request->token)->first();

        Validation::create([
            'job_category_id' => $request->job_category_id,
            'society_id' => $society->id,
            'work_experience' => $request->work_experience,
            'job_position' => $request->job_position,
            'reason_accepted' => $request->reason_accepted,
        ]);
        
        return response()->json([
            'message' => 'Request data validation sent successful',
        ], 200);
    }
}
