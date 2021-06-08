<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('ci');
            $table->string('name');
            $table->string('first_surname');
            $table->string('last_surname');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('gender');
            $table->date('birthday');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('remember_token', 100)->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('id_user_create')->nullable();
            $table->unsignedBigInteger('id_user_update')->nullable();
            $table->timestamps();
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
