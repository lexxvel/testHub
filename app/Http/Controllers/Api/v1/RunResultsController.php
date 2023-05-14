<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\RunCaseResultVersions;
use App\Models\RunResults;
use App\Models\Runs;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RunResultsController extends Controller
{

    /**
     * Добавление кейсов в тест-ран.
     * @param Request $request
     * @return array
     */
    public function create(Request $request) {
        $selectedCasesToAddInRun = $request->input('selectedCasesToAddInRun');
        $Run_id = $request->input('Run_id');
        $RunResult_SectionId = $request->input('RunResult_SectionId');
        $response = [];
        if (count($selectedCasesToAddInRun) == 0) {
            $response = [
                'status' => false,
                'error_msg' => 'Не выбран кейс для добавления в тест-ран'
            ];
        } else if (count($selectedCasesToAddInRun) == 1) { //добавляется один кейс
            //проверка на наличие кейса в задаче
            $isCaseInRun = RunResults::where('Run_id', $Run_id)->where('Task_id', $selectedCasesToAddInRun[0])->get()->count();
            if ($isCaseInRun !== 0) {
                $response = [
                    'status' => false,
                    'error_msg' => 'Кейс уже в тест-ране'
                ];
            } else {
                $task = Tasks::where('Task_id', $selectedCasesToAddInRun[0])->first();
                $req = new Request();
                //формируем запрос с Task_id для получения актуальных шагов
                $req->request->add([
                    'Task_id' => $task->Task_id
                ]);
                //вставляем в тест-ран информацию о кейсе
                $insertResult = RunResults::insert([
                    'Run_id' => $Run_id,
                    'Task_id' => $task->Task_id,
                    'steps' => (new CaseVersionsController())->getStepsByTask($req),
                    'RunResult_SectionId' => $RunResult_SectionId,
                    'created_at' => now(),
                    'Task_Version' => $task->Task_ActualVersion
                ]);
                if ($insertResult == true || $insertResult == 1) { //удачно добавлен 1 кейс в тест-ран
                    $response = [
                        'status' => true,
                        'msg' => 'Кейс добавлен в тест-ран'
                    ];
                } else { //при добавлении кейса в ран ошибка вставки
                    $response = [
                        'status' => true,
                        'msg' => 'Кейс добавлен в тест-ран'
                    ];
                }
            }
        } else if (count($selectedCasesToAddInRun) > 1) {
            $resultOfInsert = true;
            foreach ($selectedCasesToAddInRun as $case) {
                //проверка на наличие кейса в задаче
                $isCaseInRun = RunResults::where('Run_id', $Run_id)->where('Task_id', $case)->get()->count();
                if ($isCaseInRun !== 0) {
                    $response = [
                        'status' => false,
                        'error_msg' => 'Кейс уже в тест-ране'
                    ];
                } else {
                    $task = Tasks::where('Task_id', $case)->first();
                    $req = new Request();
                    //формируем запрос с Task_id для получения актуальных шагов
                    $req->request->add([
                        'Task_id' => $task->Task_id
                    ]);
                    //вставляем в тест-ран информацию о кейсе
                    $insertResult = RunResults::insert([
                        'Run_id' => $Run_id,
                        'Task_id' => $task->Task_id,
                        'steps' => (new CaseVersionsController())->getStepsByTask($req),
                        'RunResult_SectionId' => $RunResult_SectionId,
                        'created_at' => now(),
                        'Task_Version' => $task->Task_ActualVersion
                    ]);
                    if (!($insertResult == 1 || $insertResult == true)) {
                        $resultOfInsert = false;
                    }
                }
            }
            if ($resultOfInsert == true) {
                $response = [
                    'status' => true,
                    'msg' => 'Кейсы добавлены в тест-ран'
                ];
            } else {
                $response = [
                    'status' => false,
                    'error_msg' => 'При добавлении кейсов произошла ошибка'
                ];
            }

        } else {
            $response = [
                'status' => false,
                'error_msg' => 'Произошла непредвиденная ошибка'
            ];
        }
        return $response;
    }

    public function getCasesInRun(Request $request) {
        $Run_id = $request->input('Run_id');
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
             $resultVersionsCount = RunCaseResultVersions::where('RunResult_id', $case['id'])->get()->count();
             if ($resultVersionsCount > 0) { //если был прогон - записываем последний результат
                 $ActualRunStatusAndName = RunCaseResultVersions::join('run_statuses', 'run_case_result_versions.RunStatus_id', '=', 'run_statuses.RunStatus_id')
                     ->select('run_case_result_versions.RunStatus_id', 'run_statuses.RunStatus_Name')
                     ->where('run_case_result_versions.RunResult_id', $case['id'])
                     ->orderBy('id', "DESC")->first();
                 $cases[$counter] = Arr::add($cases[$counter], 'RunStatus_id' , $ActualRunStatusAndName->RunStatus_id);
                 $cases[$counter] = Arr::add($cases[$counter], 'RunStatus_Name' , $ActualRunStatusAndName->RunStatus_Name);
             } else { //Записываем null в результат прогона
                 $cases[$counter] = Arr::add($cases[$counter], 'RunStatus_id' , 5);
                 $cases[$counter] = Arr::add($cases[$counter], 'RunStatus_Name' , "Не тестировалось");
             }
            $counter = $counter + 1;
        }

        return $cases;
    }

    /**
     * Открытие страницы прогона.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function edit(Request $request) {
        $RunResult_id = $request->input('RunResult_id');
        if ($RunResult_id) {
            $TaskInRun = RunResults::join('tasks', 'tasks.Task_id', '=', 'run_results.Task_id')
                ->select('run_results.*', 'tasks.*')
                ->where('run_results.id', $RunResult_id)
                ->first();
            $RunResult = RunCaseResultVersions::where('RunResult_id', $RunResult_id)
                ->leftJoin('users', 'users.id', '=', 'run_case_result_versions.User_id')
                ->select('users.email', 'run_case_result_versions.*')
                ->orderBy('id', 'DESC')->first();

            return Inertia::render('Runs/EditRunResult', [
                'title' => "Прогон кейса '".$TaskInRun->Task_Name."'",
                'run' => $TaskInRun,
                'lastResult' => $RunResult
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * @param Request $request (id, User_id, RunStatus_id, RunResult_Comment, RunResult_TimeSpent)
     * @return array
     */
    public function makeRun(Request $request) {
        return (new RunCaseResultVersionsController)->create($request);
    }

    /**
     * Метод для маршрута - запись прогона и открытие рана.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $result = $this->makeRun($request);
        $runId = $request->input("Run_id");
        return redirect()->route('runs.edit', ['Run_id' => $runId])->withErrors($result);
    }
}
