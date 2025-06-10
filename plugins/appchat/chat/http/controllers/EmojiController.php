<?php

namespace AppChat\Chat\Http\Controllers;

use AppChat\Chat\Models\EmojiSetting;
use Illuminate\Http\Request;
use AppCore\Core\Classes\Custom\ApiResponseHelper;
use Illuminate\Routing\Controller as BaseController;

class EmojiController extends BaseController
{
    public function index(Request $request)
    {
        $emojis = EmojiSetting::all()->toArray();

        return ApiResponseHelper::jsonResponse($emojis);
    }
}
