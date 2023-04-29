<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\RunCaseResultVersions;
use App\Models\RunResults;
use Illuminate\Http\Request;

class RunCaseResultVersionsController extends Controller
{

    /**
     * Добавление версии прогона кейса в тест-ране.
     *
     * @param Request $request RunResult_id, RunStatus_id, RunResult_Comment, RunResult_TimeSpent, User_id
     * @return array JSON с ответом сервера
     */
    public function create(Request $request)
    {
        $RunResult_id = $request->input('id');
        $RunStatus_id = $request->input('RunStatus_id');
        $RunResult_Comment = $request->input('RunResult_Comment');
        $RunResult_TimeSpent = $request->input('RunResult_TimeSpent');
        $User_id = $request->input('User_id');
        $result = [];

        if ($RunResult_id && $RunStatus_id && $User_id) {

            $verCount = RunCaseResultVersions::where('RunResult_id', $RunResult_id)->get()->count();

            $InsertStatus = RunCaseResultVersions::insert([
                'RunResult_id' => $RunResult_id,
                'RunStatus_id' => $RunStatus_id,
                'User_id' => $User_id,
                'RunResult_Comment' => $RunResult_Comment,
                'RunResult_TimeSpent' => $RunResult_TimeSpent,
                'created_at' => now(),
                'version' => $verCount + 1
            ]);

            if ($InsertStatus == 1) {
                $result = [
                    "status" => true,
                    "msg" => 'Прогон выполнен. Создана версия ' . ($verCount + 1)
                ];
            } else {
                $result = [
                    "status" => false,
                    "error_msg" => 'Прогон не выполнен, при вставке в БД произошла ошибка'
                ];
            }
        } else {
            $result = [
                "status" => false,
                "error_msg" => 'Прогон не выполнен, не переданы необходимые параметры'
            ];
        }
        return $result;
    }

    /**
     * Получение результатов всех прогонов по id тест-кейса.
     *
     * @param Request $request
     * @return array
     */
    public function getResultsByCaseId(Request $request) {
        $caseId = $request->input("Task_id");
        if ($caseId) {
            return RunResults::leftJoin('run_case_result_versions', 'run_case_result_versions.RunResult_id', '=', 'run_results.id')
                ->leftJoin('users', 'users.id', '=', 'run_case_result_versions.User_id')
                ->where('run_results.Task_id', $caseId)
                ->select('run_case_result_versions.*', 'users.email')
                ->get();
        } else {
            return [
                "status" => false,
                "error_msg" => 'Не переданы необходимые параметры'
            ];
        }
    }

}
