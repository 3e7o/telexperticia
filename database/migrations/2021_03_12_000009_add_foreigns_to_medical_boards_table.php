<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToMedicalBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_boards', function (Blueprint $table) {
            $table
                ->foreign('patient_id')
                ->references('id')
                ->on('patients');
            $table
                ->foreign('doctor_id')
                ->references('id')
                ->on('doctors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medical_boards', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
        });
    }
}
