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
            $table->string('mat_asegurado');
            $table->string('mat_beneficiario');
            $table->string('gender');
            $table->date('birthday');
            $table->string('type');
            $table->string('address');
            $table->string('force');
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
