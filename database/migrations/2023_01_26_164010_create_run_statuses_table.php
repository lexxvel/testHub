<?php

use App\Models\RunStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class CreateRunStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('run_statuses', function (Blueprint $table) {
            $table->id("RunStatus_id");
            $table->string("RunStatus_Name");
            $table->timestamps();
        });


        $data =  array(
            [
                [
                    'RunStatus_id' => 1,
                    'RunStatus_Name' => 'Положительный',
                    'created_at' => Carbon::now(),
                    'updated_at' => null
                ],
                [
                    'RunStatus_id' => 2,
                    'RunStatus_Name' => 'Пропущен',
                    'created_at' => Carbon::now(),
                    'updated_at' => null
                ],
                [
                    'RunStatus_id' => 3,
                    'RunStatus_Name' => 'Блокируется',
                    'created_at' => Carbon::now(),
                    'updated_at' => null
                ],
                [
                    'RunStatus_id' => 4,
                    'RunStatus_Name' => 'Отрицательный',
                    'created_at' => Carbon::now(),
                    'updated_at' => null
                ],
                [
                    'RunStatus_id' => 5,
                    'RunStatus_Name' => 'Не тестировалось',
                    'created_at' => Carbon::now(),
                    'updated_at' => null
                ],
            ]);

        $datta = Arr::get($data, 0);

        foreach ($datta as $datum){
            $status = new RunStatuses(); //The Category is the model for your migration
            $status->RunStatus_id =$datum['RunStatus_id'];
            $status->RunStatus_Name =$datum['RunStatus_Name'];
            $status->created_at =$datum['created_at'];
            $status->save();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('run_statuses');
    }
}
