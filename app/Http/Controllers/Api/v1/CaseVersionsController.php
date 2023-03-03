<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\CaseVersions;
use App\Models\Tasks;
use Illuminate\Http\Request;

class CaseVersionsController extends Controller
{

    /**
     *  Запись версии шагов ТК
     *  @return array результата запроса
     */
    public function create(Request $request) {
        $steps = $request->input("steps");
        $Task_id = $request->input("Task_id");
        $value = $request->session()->get('user');
        $UserId = $value['id'];
        $response = [];
        if ($steps !== null && $Task_id !== null && $UserId !== null) { //если есть все необходимые параметры
            $HasVersion = CaseVersions::where('Task_id', $Task_id)->get()->count();
            if ($HasVersion == 0) { //если это первая версия
                $result = CaseVersions::insert([
                    'Task_id' => $Task_id,
                    'steps' => json_encode($steps),
                    'version'=> 1,
                    'User_id' => $UserId,
                    'created_at' => now()
                ]);
                if ($result === 1 || $result === true) { //если удалось создать версию

                    //устанавливаем в задаче актуальную версию 1
                    $updateTaskVerResult = Tasks::where('Task_id', $Task_id)->update([
                        'Task_ActualVersion' => 1,
                    ]);

                    if ($updateTaskVerResult === 1 || $updateTaskVerResult === true) {
                        $response = [
                            'status' => true,
                            'msg' => 'Шаги сохранены в версию 1'
                        ];
                    } else {
                        $response = [
                            'status' => false,
                            'msg' => 'При установки актуальной версии тест-кейса произошла ошибка'
                        ];
                    }
                } else {
                    $response = [
                        'status' => false,
                        'msg' => 'При создании версии произошла ошибка'
                    ];
                }


            } else if ($HasVersion > 0) { //Если уже есть версия
                $curVersion = CaseVersions::where('Task_id', $Task_id)->orderBy('id', 'DESC')->first()->version;
                $curSteps = CaseVersions::where('Task_id', $Task_id)->orderBy('id', 'DESC')->first()->steps;

                if ($curSteps === json_encode($steps)) { //если шаги не поменялись
                    $response = [
                        'status' => true,
                        'msg' => ''
                    ];
                } else {  //если версия шагов изменилась - создаем новуб версию
                    $result = CaseVersions::insert([
                        'Task_id' => $Task_id,
                        'steps' => json_encode($steps),
                        'version'=> $curVersion + 1,
                        'User_id' => $UserId,
                        'created_at' => now()
                    ]);
                    if ($result === 1 || $result === true) { //если версия добавилась

                        //устанавливаем в задаче актуальную версию - новую
                        $updateTaskVerResult = Tasks::where('Task_id', $Task_id)->update([
                            'Task_ActualVersion' => $curVersion + 1,
                        ]);

                        if ($updateTaskVerResult === 1 || $updateTaskVerResult === true) { //если удачно установили актуальную версию в ТК
                            $response = [
                                'status' => true,
                                'msg' => 'Шаги сохранены в версию ' . ($curVersion + 1)
                            ];
                        } else { //если не удалось обновить версию задачи
                            $response = [
                                'status' => false,
                                'msg' => 'При обновлении актуальной версии произошла ошибка'
                            ];
                        }
                    } else { //если версия шагов не создалась
                        $response = [
                            'status' => false,
                            'msg' => 'При создании версии произошла ошибка'
                        ];
                    }
                }
            }
        } else { //если не переданы параметры
            $response = [
                'status' => false,
                'msg' => 'При создании версии произошла ошибка. Не переданы необходимые параменты, либо закончилась сессия'
            ];
        }
        return $response;
    }

    /**
     *  Получение актуальной версии шагов кейса по id кейса
     *  @return JSON результата запроса
     */
    public function getStepsByTask(Request $request) {
        $TaskId = $request->request->get('Task_id');
        //$TaskId = $request->input("Task_id");
        $Task_ActualVersion = Tasks::where('Task_id', $TaskId)->first()->Task_ActualVersion;
        return CaseVersions::where("Task_id", $TaskId)->where("version", $Task_ActualVersion)->orderBy('id', 'DESC')->first()->steps;
    }

    public function getVersionsByTask(Request $request) {
        $Task_id = $request->input('Task_id');
        return CaseVersions::join('users', 'users.id', '=', 'case_versions.User_id')
            ->select('users.email', 'case_versions.version', 'case_versions.created_at', 'case_versions.steps')
            ->where('case_versions.Task_id', $Task_id)
            ->orderBy('case_versions.version', 'DESC')
            ->get();
    }
}
