<?php

namespace AppChat\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateReactionsTable extends Migration
{
    public function up()
    {
        Schema::create('appchat_reactions', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_id');
            $table->unsignedBigInteger('user_id');
            $table->string('emoji');
            $table->timestamps();

            $table->unique(['message_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('appchat_reactions');
    }
}
