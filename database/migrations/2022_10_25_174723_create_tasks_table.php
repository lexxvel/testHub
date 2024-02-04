<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('Task_id');
            $table->unsignedBigInteger('Task_Project');
            $table->string('Task_JiraProject')->nullable();
            $table->string('Task_Number')->nullable();
            $table->string('Task_Name');
            $table->string('Task_Priority');
            $table->string('Task_Stage');
            $table->string('Task_isActual')->nullable();
            $table->integer('Task_Folder')->nullable();
            $table->integer('Task_isForRegress')->nullable();
            $table->integer('Task_ActualVersion');
            $table->timestamps();
            $table->foreign('Task_Project')->references('Project_id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
