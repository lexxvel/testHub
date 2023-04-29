<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('User_Role');
            $table->rememberToken();
            $table->timestamps();
        });

        /*
         * $data =  array(
            [
                'name' => 'Category1',
            ],
            [
                'name' => 'Category2',
            ],
            [
                'name' => 'Category3',
            ],
        );
        foreach ($data as $datum){
            $category = new Category(); //The Category is the model for your migration
            $category->name =$datum['name'];
            $category->save();
        }
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
