<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    use UploadImageTrait;
    public function register(RegisterRequest $request)
    {
        $data = $request->only('username','email','password');
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadImage($request, 'image', 'user_images');
            $user->image = $imagePath;
            $user->save();
        }
        $user->token = $user->createToken('socialmedia')->plainTextToken;

        return ApiResponse::sendResponse(201, __('messages.user_created'), new UserResource($user));
    }
}
