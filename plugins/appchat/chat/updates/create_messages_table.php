<?php

namespace Slack\Appchat\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateMessagesTable Migration
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
        Schema::create('appchat_messages', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->unsignedBigInteger('user_id');
            $table->text('content')->nullable()->default(null);
            $table->unsignedBigInteger('parent_id')->nullable()->default(null);
            $table->timestamps(0);

            // Indexy pre rýchlejšie vyhľadávanie
            $table->index('chat_id');
            $table->index('user_id');
            $table->index('parent_id');
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('appchat_messages');
    }
};
