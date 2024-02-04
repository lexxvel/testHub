<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('run_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("Run_id");
            $table->unsignedBigInteger("Task_id");
            $table->text("steps")->nullable();
            $table->unsignedBigInteger("User_id")->nullable();
            $table->integer("RunResult_SectionId")->nullable();
            $table->integer("Task_Version");
            $table->timestamps();
            $table->foreign('Task_id')->references('Task_id')->on('tasks')->onDelete('cascade');
            $table->foreign('User_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('Run_id')->references('Run_id')->on('runs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('run_results');
    }
}
