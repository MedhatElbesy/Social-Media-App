<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return ApiResponse::sendResponse(401,__('messages.Invalid_credentials'));
        }

        $user = Auth::user();
        $user->token = $user->createToken('auth_token')->plainTextToken;

        return ApiResponse::sendResponse(200, __('messages.login_success'), new UserResource($user));
    }
}
