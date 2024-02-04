<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_versions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("Task_id");
            $table->integer("version");
            $table->text("steps");
            $table->unsignedBigInteger("User_id");
            $table->timestamps();
            $table->foreign('Task_id')->references('Task_id')->on('tasks')->onDelete('cascade');
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
        Schema::dropIfExists('case_versions');
    }
}
