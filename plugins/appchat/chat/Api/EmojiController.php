<?php

namespace AppChat\Chat\Api;

use AppChat\Chat\Helpers\ApiResponseHelper;
use AppChat\Chat\Models\EmojiSetting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class EmojiController extends BaseController
{
    public function index(Request $request)
    {
        $setting = EmojiSetting::first();
        $emojis = $setting->emojis ?? [];

        return ApiResponseHelper::jsonResponse($emojis);
    }
}
