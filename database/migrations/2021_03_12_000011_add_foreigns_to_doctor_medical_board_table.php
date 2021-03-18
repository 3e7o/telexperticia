<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToDoctorMedicalBoardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_medical_board', function (Blueprint $table) {
            $table
                ->foreign('doctor_id')
                ->references('id')
                ->on('doctors');
            $table
                ->foreign('medical_board_id')
                ->references('id')
                ->on('medical_boards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_medical_board', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->dropForeign(['medical_board_id']);
        });
    }
}
