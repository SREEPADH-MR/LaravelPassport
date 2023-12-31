<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Register the user.
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = [];
        $credentials['name'] = $request->input('name');
        $credentials['email'] = $request->input('email');
        $credentials['password'] = Hash::make($request->input('password'));

        $response = User::create($credentials);

        return response()->json([
            'message' => 'Registration Successful',
            'data' => $response->toArray(),
            'error' => '',
        ]);
    }

    /**
     * Login the user.
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $token = $request->user()->createToken('login');

            return response()->json([
                'message' => 'Login Successful',
                'data' => $token,
                'error' => '',
            ]);
        }

        return response()->json([
            'message' => 'Login Failed',
            'data' => [],
            'error' => '',
        ]);
    }

    /**
     * Get the user.
     */
    public function getUser(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'User details',
            'data' =>  Auth::user(),
            'error' => '',
        ]);
    }
}
