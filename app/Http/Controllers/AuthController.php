<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponseTrait;
    public function login(Request $request):JsonResponse
    {
        $validated =  $request->validate([
           'email' => 'required|email',
           'password' => 'required'
        ]);
        if(!Auth::attempt($validated)){
            return $this->errorResponse('Invalid user credentials', 401);
        }

        $user = User::where('email', $validated['email'])->firstOrFail();
        $token = $user->createToken('api_token')->plainTextToken;

        $responseData = [
            'user' => $user['name'],
            'access_token' => $token,
            'token_type' => 'Bearer'
        ];

        return $this->successResponse($responseData, 'Login successful');
    }

    public function register(Request $request):JsonResponse
    {
        $validated =  $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);
        $token = $user->createToken('api_token')->plainTextToken;

        $responseData = [
            'user' => $user['name'],
            'access_token' => $token,
            'token_type' => 'Bearer'
        ];

        return $this->successResponse($responseData, 'Registration successful');
    }
}
