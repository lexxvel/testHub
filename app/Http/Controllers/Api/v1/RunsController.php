<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Models\Runs;
use Inertia\Inertia;
use Psy\Util\Json;

class RunsController extends Controller
{
    public function getRuns() {
        return Runs::all();
    }

    public function getRunsByProject(Request $request) {
        $tasksProject = $request->input('Project_id');
        return Runs::where('Project_id', $tasksProject)->orderBy('Run_id', 'DESC')->get();
    }

    public function index(Request $request) {
        $tasksProject = $request->input('Project_id');
        if ($tasksProject === null) {
            $result = [
                'status' => 'false',
                'error_msg' => 'Для просмотра тест-ранов требуется указать проект'
            ];
            return redirect()->route('projects')->withErrors($result);
        } else {
            return Inertia::render('Runs/Index', [
                'title' => 'Тест-раны',
                'runs' => $this->getRunsByProject($request)
            ]);
        }
    }

    public function create() {
        return Inertia::render('Runs/Create', [
            'title' => 'Добавить тест-ран',
        ]);
    }

    public function store(Request $request) {
        $result = $this->addRun($request);
        $goBackProject = $request->input('Project_id');
        return redirect()->route('runs', ['Project_id' => $goBackProject])->withErrors($result);
    }


    /**
     *  Создание тест-рана - запись в БД
     *  @return JSON результата запроса
     */
    public function addRun(Request $request) {
        $request->validate([
            'Project_id' => 'required|max:255',
            'Run_Name' => 'required|max:255',
            'Run_Type' => 'required|max:255',
        ]);
        $JiraProject = $request->input("Project_id");
        $Name = $request->input("Run_Name");
        $Type = $request->input("Run_Type");
        $Desc = $request->input("Run_Desc");
        $Status = $request->input("Run_Status");
        $EndDate = $request->input("Run_EndDate");
        if ($EndDate) {
            $date = Carbon::createFromFormat('Y-m-d', $EndDate)->format('Y/m/d');
        } else {
            $date = null;
        }

        $newTree = '{"id":0,"name":"Тест-ран","id_counter":3,"root":true,"children":[{"id":1,"name":"Задачи"},{"id":2,"name":"Регрессионные кейсы"}]}';

        $result = Runs::insert([
            'Project_id' => $JiraProject,
            'Run_Name' => $Name,
            'Run_Type' => $Type,
            'Run_Desc' => $Desc ? $Desc : null,
            'Run_Status' => $Status ? $Status : 0,
            'Run_EndDt' => $date ? $date : null,
            'Run_Tree' => $newTree,
            'created_at' => now()
        ]);

        if ($result === 1 || $result === true) {
            $newRunId = Runs::orderBy('Run_id', 'DESC')->first()->Run_id;

            return [
                "status" => "true",
                "msg" => "Тест-ран " . $newRunId . " создан",
                "Run_id" => $newRunId
            ];
        } else {
            return [
                "status" => "false",
                "error_msg" => "При создании тест-рана произошла ошибка"
            ];
        }
    }

    /**
     * Смена статуса тест-рана.
     *
     * @param Request $request
     * @return Json
     */
    public function changeRunStatus(Request $request) {
        //$JiraProject = $request->input("Project_id");
        $Run = $request->input("Run_id");
        $Status = $request->input("Run_Status");
        if ($Run !== null && $Status !== null) {
            $result = Runs::where('Run_id', $Run)->update([
                'Run_Status' => $Status
            ]);
            if ($result === 1 || $result === true) {
                return [
                    'status' => "true",
                    'msg' => "Статус тест-рана обновлен"
                ];
            } else {
                return [
                    'status' => "false",
                    'error_msg' => "При обновлении статуса тест-рана произошла ошибка"
                ];
            }
        } else {
            return [
                'status' => "false",
                'error_msg' => "Не переданы обязательные параметры"
            ];
        }
    }

    /**
     * Редактировование тест-рана (рендер страницы редактирования рана)
     */
    public function edit(Request $request) {
        $runId = $request->input("Run_id");
        $run = Runs::where('Run_id', $runId)
            ->leftjoin('projects', 'runs.Project_id', '=', 'projects.Project_id')
            ->first();
        //$value = $request->session()->get('_token');
        $value = $request->session()->get('user');
        $tree = (new Runs)->getTree($runId);
        //dd($value['email']);
        return Inertia::render('Runs/Edit', [
            'title' => $run->Run_Name,
            'run' => $run,
            'user' => $value,
            'tree' => $tree
        ]);
    }

    public function getRunStatistic(Request $request) {
        $runId = $request->input("Run_id");
        return (new Runs)->getRunStatistic($runId);
    }

    /**
     * Обновление дерева рана
     * @param Request $request должен содержать Run_id и tree
     * @return array
     */
    public function updateTree(Request $request): array
    {
        $Run_id = (int) $request->input("Run_id");
        $tree = $request->input("tree");
        return (new Runs)->updateTree($Run_id, $tree);
    }

}
