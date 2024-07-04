<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiTokenRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ApiTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ApiTokenRequest $request
     * @return JsonResponse
     */
    public function createToken(ApiTokenRequest $request): JsonResponse
    {
        $validator = $request->validated();
        $user = User::where('email', $validator['email'])->first();
        if (!$user || !Hash::check($validator['password'], $user->password)) {
            return response()->json(['error' => 'The provided credentials are incorrect'], Response::HTTP_UNAUTHORIZED);
        }
        $token = $user->createToken($validator['email']);
        return response()->json(['token' => $token->plainTextToken], Response::HTTP_CREATED);
    }
}
