<?php namespace Appchat\Chat\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateChatsTable Migration
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
        Schema::create('appchat_chats', function(Blueprint $table) {
            $table->id();
            $table->string('name')->default('New Chat'); // default hodnota pre name
            $table->timestamps(0); // bez mikrosekúnd, ak chceš
        });

        Schema::create('appchat_chat_user', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps(0);

            $table->unique(['chat_id', 'user_id']);
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('appchat_chat_user');
        Schema::dropIfExists('appchat_chats');
    }
};
