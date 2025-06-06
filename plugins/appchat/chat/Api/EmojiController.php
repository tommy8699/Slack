<?php

namespace AppChat\Chat\Api;

use AppChat\Chat\Helpers\ApiResponseHelper;
use AppChat\Chat\Models\EmojiSetting;
use Illuminate\Routing\Controller as BaseController;

class EmojiController extends BaseController
{
    public function index()
    {
        $setting = EmojiSetting::instance();
        $emojis = json_decode($setting->available_emojis ?? '[]');
        return ApiResponseHelper::jsonResponse($emojis);
    }
}
