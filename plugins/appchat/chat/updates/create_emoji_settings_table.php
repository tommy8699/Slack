<?php

namespace AppChat\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateEmojiSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('appchat_emoji_settings', function(Blueprint $table) {
            $table->id();
            $table->text('emojis')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appchat_emoji_settings');
    }
}
