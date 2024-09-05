<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function setLocale($locale)
    {

        if (in_array($locale, ['en', 'ar'])) {
            App::setLocale($locale);

            session(['locale' => $locale]);
            return ApiResponse::sendResponse(200,__('messages.locale_changed'));
        }
            return ApiResponse::sendResponse(404,__('messages.invalid_locale'));

    }
}
