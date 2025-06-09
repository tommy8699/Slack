<?php

namespace AppChat\Chat\Http\Controllers;

use AppChat\Chat\Helpers\ApiResponseHelper;
use AppChat\Chat\Models\EmojiSetting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class EmojiController extends BaseController
{
    public function index(Request $request)
    {
        $emojis = EmojiSetting::all()->toArray();

        return ApiResponseHelper::jsonResponse($emojis);
    }
}
