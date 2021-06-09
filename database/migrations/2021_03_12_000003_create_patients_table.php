<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ci');
            $table->string('name');
            $table->string('first_surname');
            $table->string('last_surname');
            $table->string('email')->unique();
            $table->string('gender');
            $table->date('birthday');
            $table->string('phone')->nullable();
            $table->string('mat_asegurado')->nullable();
            $table->string('mat_beneficiario')->nullable();
            $table->string('type')->nullable();
            $table->string('address')->nullable();
            $table->string('force')->nullable();
			$table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('patients');
    }
}
