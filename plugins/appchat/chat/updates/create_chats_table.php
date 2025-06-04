<?php

namespace AppChat\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateChatsTable extends Migration
{
    public function up()
    {
        Schema::create('appchat_chats', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('appchat_chat_user', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->unique(['chat_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('appchat_chat_user');
        Schema::dropIfExists('appchat_chats');
    }
}
