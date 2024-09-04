<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\CreateTweetRequest;
use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use Exception;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function createTweet(CreateTweetRequest $request)
    {
        try {
            $tweet = new Tweet([
                'user_id' => Auth::id(),
                'tweet' => $request->input('tweet'),
            ]);

            $tweet->save();
            return ApiResponse::sendResponse(201, __('messages.tweet_created_success'), new TweetResource($tweet));
        } catch (Exception $e) {
            return ApiResponse::sendResponse(500, __('messages.fail_to_create_tweet'));
        }
    }
}
