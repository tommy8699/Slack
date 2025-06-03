<?php

namespace AppChat\Chat\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateChatsTable extends Migration
{
    public function up()
    {
        Schema::create('appchat_chat_chats', function ($table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appchat_chat_chats');
    }
}
