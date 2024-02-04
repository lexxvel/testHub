<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runs', function (Blueprint $table) {
            $table->id("Run_id");
            $table->unsignedBigInteger("Project_id");
            $table->string("Run_Name");
            $table->integer("Run_Type");
            $table->integer("Run_Status");
            $table->text("Run_Tree");
            $table->string("Run_Desc")->nullable();
            $table->date("Run_EndDt")->nullable();
            $table->timestamps();
            $table->foreign('Project_id')->references('Project_id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('runs');
    }
}
