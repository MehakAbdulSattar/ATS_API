<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HR;


class HRController extends Controller
{
    public function register(Request $request)
    {                                                                             
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'company_name' => 'required|string',
            
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);

        $hr=HR::create([
            'user_id' => $user->id,
            'company_name' => $request->company_name,
        ]);

        $responseData = [
            'message' => 'HR registered successfully',
            'user' => [
                'id' => $user->id,
                'hr_id' => $hr->id,
                'name' => $user->name,
                'email' => $user->email,
                'company_name' => $hr->company_name,
                'updated_at' => $user->updated_at,
                'created_at' => $user->created_at,
            ]
        ];

        return response()->json($responseData, 201);
    }

}
