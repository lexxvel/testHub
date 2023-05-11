<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Runs extends Model
{
    use HasFactory;

    public function getRunStatistic($Run_id) {
        if (!$Run_id) {
            return [
                'status' => false,
                'error_msg' => 'Не передан обязательный параметр'
            ];
        }
        $cases = RunResults::join('tasks', 'tasks.Task_id', '=', 'run_results.Task_id')
            ->select('run_results.*', 'tasks.*')
            ->where('Run_id', $Run_id)
            ->get();
        $counter = 0;
        //передача статуса кейса - результата последнего прогона
        foreach ($cases as $case) {
            $resultVersionsCount = DB::table('run_case_result_versions')
                ->where('RunResult_id', $case['id'])
                ->get()->count();
            if ($resultVersionsCount > 0) { //если был прогон - записываем последний результат
                $ActualRunStatusAndName = RunCaseResultVersions::join('run_statuses', 'run_case_result_versions.RunStatus_id', '=', 'run_statuses.RunStatus_id')
                    ->select('run_case_result_versions.RunStatus_id', 'run_statuses.RunStatus_Name')
                    ->where('RunResult_id', $case['id'])
                    ->orderBy('id', "DESC")->first();
                $cases[$counter] = Arr::add($cases[$counter], 'RunStatus_id' , $ActualRunStatusAndName->RunStatus_id);
                $cases[$counter] = Arr::add($cases[$counter], 'RunStatus_Name' , $ActualRunStatusAndName->RunStatus_Name);
            } else { //Записываем null в результат прогона
                $cases[$counter] = Arr::add($cases[$counter], 'RunStatus_id' , 5);
                $cases[$counter] = Arr::add($cases[$counter], 'RunStatus_Name' , "Не тестировалось");
            }
            $counter = $counter + 1;
        }

        $result = [
            ["RunStatus_id" => 1, "RunStatus_Name" => "Положительный", "count" => 0],
            ["RunStatus_id" => 2, "RunStatus_Name" => "Пропущен", "count" => 0],
            ["RunStatus_id" => 3, "RunStatus_Name" => "Блокируется", "count" => 0],
            ["RunStatus_id" => 4, "RunStatus_Name" => "Отрицательный", "count" => 0],
            ["RunStatus_id" => 5, "RunStatus_Name" => "Не тестировалось", "count" => 0],
            ];

        foreach ($cases as $case) {
            switch ($case->RunStatus_id) {
                case 1:
                    $count = Arr::get($result[0], 'count');
                    Arr::set($result[0], 'count', $count + 1);
                    break;
                case 2:
                    $count = Arr::get($result[1], 'count');
                    Arr::set($result[1], 'count', $count + 1);
                    break;
                case 3:
                    $count = Arr::get($result[2], 'count');
                    Arr::set($result[2], 'count', $count + 1);
                    break;
                case 4:
                    $count = Arr::get($result[3], 'count');
                    Arr::set($result[3], 'count', $count + 1);
                    break;
                case 5:
                    $count = Arr::get($result[4], 'count');
                    Arr::set($result[4], 'count', $count + 1);
                    break;
                default:
                    break;
            }
        }
        return $result;

    }
}
