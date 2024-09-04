<?php

namespace App\Http\Controllers;

use App\Events\UserFollowedEvent;
use App\Helpers\ApiResponse;
use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function follow(User $user)
    {
        try {
            $follower = Auth::user();
            $follower->following()->attach($user->id);
            broadcast(new UserFollowedEvent($follower, $user));

            return ApiResponse::sendResponse(200, __('messages.follow_success'));
        } catch (Exception $e) {
            return ApiResponse::sendResponse(500, __('messages.error_occurred'));
        }
    }

    public function timeline()
    {
        try {

            if (!Auth::check()) {
                return ApiResponse::sendResponse(401,__('messages.not_authenticated'));
            }

            $user = Auth::user();
            $following_ids = $user->following()->pluck('user_id');
            $tweets = Tweet::whereIn('user_id', $following_ids)
                ->orderBy('created_at', 'desc')
                ->paginate(5);
            return ApiResponse::sendResponse(200,__('messages.timeline_loaded'),TweetResource::collection($tweets));
        } catch (Exception $e) {
            return ApiResponse::sendResponse(500,__('messages.error_occurred'));
        }
    }
}
