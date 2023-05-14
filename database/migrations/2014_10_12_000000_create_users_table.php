<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
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

        $data =  array(
            [
                'email' => 'admin',
                'password' => '$2y$10$bEn2D3dyaAOqRCE7RC1QzeY9GfkDVHxwJxN3.nTDqv98L5Q7favwa',
                'User_Role' => 99,
                'createdAt' => Carbon::now()
            ]);

        foreach ($data as $datum){
            $user = new User(); //The Category is the model for your migration
            $user->email =$datum['email'];
            $user->password =$datum['password'];
            $user->User_Role =$datum['User_Role'];
            $user->save();
        }

        /*
         * $data =  array(
            [
                'name' => 'Category1',

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
