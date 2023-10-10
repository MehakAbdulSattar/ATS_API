<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Job;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function createJob(Request $request)
    {
        $hr = Auth::user();
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
            'requirements' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $job = Job::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'requirements' => $request->input('requirements'), 
            'hr_id' => $hr->id,
        ]);

        return response()->json(['message' => 'Job created successfully', 'job' => $job], 201);
    }

    public function updateJob(Request $request, $id)
    {
        $hr = Auth::user();
        $job = Job::find($id);

        if (!$job) {
            return response()->json(['error' => 'Job not found'], 404);
        }

        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
            'requirements' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Update job details
        $job->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'requirements' => $request->input('requirements'),
            'hr_id' => $hr->id,
        ]);

        return response()->json(['message' => 'Job updated successfully', 'job' => $job], 200);
    }

    public function showJob($id)
    {
        $job = Job::find($id);

        if (!$job) {
            return response()->json(['error' => 'Job not found'], 404);
        }

        return response()->json(['job' => $job], 200);
    }

    public function showAllJobs()
    {
        $jobs = Job::all();

        return response()->json(['jobs' => $jobs], 200);
    }

    public function deleteJob($id)
    {
        $job = Job::find($id);

        if (!$job) {
            return response()->json(['error' => 'Job not found'], 404);
        }

        $job->delete();

        return response()->json(['message' => 'Job deleted successfully'], 200);
    }



}
