<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_boards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date');
            $table->enum('status', ['Programado', 'Confirmado', 'Cancelado', 'Reprogramar']);
            $table->string('meet');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->boolean('open_zoom')->default('0');
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
        Schema::dropIfExists('medical_boards');
    }
}
