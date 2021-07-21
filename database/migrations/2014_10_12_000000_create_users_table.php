<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('id_name');
            $table->string('id_value');

            $table->string('title_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female']);
            $table->string('email')->unique();
            $table->dateTime('dob_date');
            $table->integer('dob_age');
            $table->dateTime('registered_date');
            $table->integer('registered_age');
            $table->string('phone')->nullable();
            $table->string('cell')->nullable();
            $table->string('nat');

            $table->string('large_picture')->nullable();
            $table->string('medium_picture')->nullable();
            $table->string('thumbnail_picture')->nullable();

            $table->dateTime('imported_t')->default(now()->format('Y-m-d H:i:s'));
            $table->enum('status', ['draft', 'trash', 'published']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
