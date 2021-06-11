<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ci')->unique();
            $table->string('name');
            $table->string('first_surname');
            $table->string('last_surname');
            $table->string('email')->unique();
            $table->string('regional');
            $table->string('signature', 100)->nullable();
			$table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('specialty_id');
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
        Schema::dropIfExists('doctors');
    }
}
