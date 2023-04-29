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
            $table->integer('RunResult_id');
            $table->integer('RunStatus_id');
            $table->text('RunResult_Comment')->nullable();
            $table->integer('RunResult_TimeSpent')->nullable();
            $table->integer('User_id');
            $table->integer('version');
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
        Schema::dropIfExists('run_case_result_versions');
    }
}
