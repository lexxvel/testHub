<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunCaseResultVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('run_case_result_versions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('RunResult_id');
            $table->unsignedBigInteger('RunStatus_id');
            $table->text('RunResult_Comment')->nullable();
            $table->integer('RunResult_TimeSpent')->nullable();
            $table->unsignedBigInteger('User_id');
            $table->integer('version');
            $table->timestamps();
            $table->foreign('RunResult_id')->references('id')->on('run_results')->onDelete('cascade');
            $table->foreign('RunStatus_id')->references('RunStatus_id')->on('run_statuses')->onDelete('cascade');
            $table->foreign('User_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('run_case_result_versions');
    }
}
