<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Candidate;



class CandidateController extends Controller
{
    public function register(Request $request)
    {                                                                             
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'phone_number' => 'required|string',
            
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);

        $candidate=Candidate::create([
            'user_id' => $user->id,
            'phone_number' => $request->phone_number,
        ]);

        $responseData = [
            'message' => 'Candidate registered successfully',
            'user' => [
                'id' => $user->id,
                'candidate_id' => $candidate->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $candidate->phone_number,
                'updated_at' => $user->updated_at,
                'created_at' => $user->created_at,
            ]
        ];

        return response()->json($responseData, 201);
    }
}
