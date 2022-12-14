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
            $table->string('Task_Project');
            $table->string('Task_JiraProject');
            $table->string('Task_Number');
            $table->string('Task_Name');
            $table->string('Task_Priority');
            $table->string('Task_Stage');
            $table->string('Task_isActual')->nullable();
            $table->string('Task_Folder')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
