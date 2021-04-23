<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('group_parameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('id_user_create');
            $table->unsignedBigInteger('id_user_update')->nullable();
            $table->timestamps();
        });

        Schema::create('parameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_id');
            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status');
            $table->unsignedBigInteger('id_user_create');
            $table->unsignedBigInteger('id_user_update')->nullable();
            $table->timestamps();

            $table->foreign('group_id')
                ->references('id')
                ->on('group_parameters')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_parameters');
        Schema::dropIfExists('parameters');
    }
}
