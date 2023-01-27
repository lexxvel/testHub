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
            $table->integer("Task_id");
            $table->integer("RunStatus_id")->nullable();
            $table->text("RunResult_Comment")->nullable();
            $table->integer("RunResult_TimeSpent")->nullable();
            $table->integer("User_id")->nullable();
            $table->integer("RunResult_SectionId")->nullable();
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
        Schema::dropIfExists('run_results');
    }
}
