<?php

namespace AppChat\Api;

use AppChat\Models\EmojiSetting;
use Illuminate\Routing\Controller as BaseController;

class EmojiController extends BaseController
{
    public function index()
    {
        $setting = EmojiSetting::instance();
        $emojis = json_decode($setting->available_emojis ?? '[]');
        return response()->json($emojis);
    }
}
