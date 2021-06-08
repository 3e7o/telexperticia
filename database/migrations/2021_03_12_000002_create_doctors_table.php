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
            $table->string('signature', 100)->nullable();
            $table->string('regional_id')->nullable();
			$table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('specialty_id')->nullable();
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
        Schema::dropIfExists('doctors');
    }
}
