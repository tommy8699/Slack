<?php

namespace AppUser\User\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateUsersTable Migration
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
        Schema::create('appuser_user_users', function(Blueprint $table)
        {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name')->default('');        // Pridal som default prázdny reťazec
            $table->string('token')->nullable()->default(null);
            $table->timestamps(0);

            // Pre rýchle vyhľadávanie podľa mena, ak bude potrebné
            $table->index('name');
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('appuser_user_users');
    }
};
