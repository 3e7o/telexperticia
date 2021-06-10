<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_id');
            $table->text('record_familiar')->nullable();
            $table->text('record_clinic')->nullable();
            $table->text('blood_type')->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('id_user_create')->nullable();
            $table->unsignedBigInteger('id_user_update')->nullable();
            $table->timestamps();
        });

        Schema::create('vaccines', function (Blueprint $table) {
            $table->unsignedBigInteger('parameter_id');
            $table->unsignedBigInteger('record_id');
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('id_user_create')->nullable();
            $table->unsignedBigInteger('id_user_update')->nullable();
            $table->timestamps();
            $table
                ->foreign('parameter_id')
                ->references('id')
                ->on('parameters');
            $table
                ->foreign('record_id')
                ->references('id')
                ->on('records');
        });
        Schema::create('allergies', function (Blueprint $table) {
            $table->unsignedBigInteger('parameter_id');
            $table->unsignedBigInteger('record_id');
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('id_user_create')->nullable();
            $table->unsignedBigInteger('id_user_update')->nullable();
            $table->timestamps();
            $table
                ->foreign('parameter_id')
                ->references('id')
                ->on('parameters');
            $table
                ->foreign('record_id')
                ->references('id')
                ->on('records');
        });
        Schema::create('operations', function (Blueprint $table) {
            $table->unsignedBigInteger('parameter_id');
            $table->unsignedBigInteger('record_id');
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('id_user_create')->nullable();
            $table->unsignedBigInteger('id_user_update')->nullable();
            $table->timestamps();
            $table
                ->foreign('parameter_id')
                ->references('id')
                ->on('parameters');
            $table
                ->foreign('record_id')
                ->references('id')
                ->on('records');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
        Schema::dropIfExists('vaccines');
        Schema::dropIfExists('allergies');
        Schema::dropIfExists('operations');
        Schema::dropForeign('patient_id');
    }
}
