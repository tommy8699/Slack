<?php namespace Appchat\Chat\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateEmojiSettingsTable Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('appchat_emoji_settings', function(Blueprint $table) {
            $table->id();
            $table->text('emojis')->nullable()->default(null); // explicitne nullable s default null
            $table->timestamps(0); // timestamps bez mikrosekúnd, môžeš dať aj bez parametra
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('appchat_emoji_settings');
    }
};
