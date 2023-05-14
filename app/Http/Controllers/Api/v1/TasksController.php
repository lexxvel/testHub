<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Steps;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Tasks;

class TasksController extends Controller
{

    public function index(Request $request) {
        $tasksProject = $request->session()->get('prefProject');
        if ($tasksProject === null) {
            $result = [
                'status' => 'false',
                'error_msg' => 'Для просмотра задач требуется выбрать проект'
            ];
            return redirect()->route('projects')->withErrors($result);
        } else {
            //$tree = Project::where('Project_id', $tasksProject)->first()->Project_CasesTree;
            $request->request->set('Project_id', $tasksProject);
            $tree = (new ProjectController)->getProjectTree($request);
            return Inertia::render('Tasks/Index', [
                'title' => 'Тест-кейсы',
                'tasks' => $this->getCasesByProject($request),
                'tree' => $tree
            ]);
        }
    }

    public function getCasesByProject(Request $request) {
        $tasksProject = $request->input("Project_id");
        return Tasks::where('Task_Project', $tasksProject)->get();
    }

    public function create(Request $request) {
        $selected = $request->input('selected');
        return Inertia::render('Tasks/Create', [
            'title' => 'Создание кейса',
            'selectedFolder' => $selected
        ]);
    }

    /**
     *  Создание задачи
     *  @return Inertia object
     */
    public function store(Request $request) {
        $result = $this->addTask($request);
        $goBackProject = $request->input('Task_Project');
        return redirect()->route('tasks', ['Project_id' => $goBackProject])->withErrors($result);
    }

    /**
     *  Удаление задачи
     *  @return Inertia object
     */
    public function destroy(Request $request) {
        $result = $this->deleteTask($request);
        return redirect()->back()->withErrors($result);
    }

    /**
     * Редактировование задачи (рендер страницы редактирования задачи)
     */
    public function edit(Request $request) {
        $taskId = $request->input("Task_id");
        $task = Tasks::where('Task_id', $taskId)->first();
        return Inertia::render('Tasks/Edit', [
            'task' => $task
        ]);
    }

    /**
     *  Редактирование задачи
     *  @return Inertia object
     */
    public function update(Request $request) {
        $goBackProject = $request->input('Task_Project');
        $result = $this->updateTask($request);
        return redirect()->route('tasks', ['Project_id' => $goBackProject])->withErrors($result);
    }


    /**
     *  Создание задачи - запись в БД
     *  @return JSON результата запроса
     */
    public function addTask(Request $request) {
        $isForRegress = $request->input("Task_isForRegress");

        if ($isForRegress === true) {
            $request->validate([
                'Task_Name' => 'required|max:255',
                'Task_Priority' => 'required|max:255',
                'Task_Stage' => 'required|max:255',
                'Task_Project' => 'required|max:255',
            ]);
        } else {
            $request->validate([
                'Task_JiraProject' => 'required|max:255',
                'Task_Name' => 'required|max:255',
                'Task_Number' => 'required|max:255',
                'Task_Priority' => 'required|max:255',
                'Task_Stage' => 'required|max:255',
                'Task_Project' => 'required|max:255',
            ]);
        }
        $JiraProject = $request->input("Task_JiraProject");
        $Name = $request->input("Task_Name");
        $Number = $request->input("Task_Number");
        $Priority = $request->input("Task_Priority");
        $Stage = $request->input("Task_Stage");
        $Project = $request->input("Task_Project");
        $Folder = $request->input("Task_Folder");

        $result = Tasks::insert([
            'Task_JiraProject' => $JiraProject,
            'Task_Name' => $Name,
            'Task_Number' => $Number,
            'Task_Priority' => $Priority,
            'Task_Stage' => $Stage,
            'Task_Project' => $Project,
            'Task_isForRegress' => $isForRegress,
            'Task_Folder' => $Folder,
            'Task_ActualVersion' => 1,
            'created_at' => now()
        ]);

        if ($result === 1 || $result === true) {
            $newTaskId = Tasks::orderBy('Task_id', 'DESC')->first()->Task_id;
            //$steps = $request->input("steps");
            $request->request->add(['Task_id' => $newTaskId]);
            $CreateVersionResult = (new CaseVersionsController())->create($request);
            if ($CreateVersionResult['status'] == true) {
                return [
                    "status" => true,
                    "msg" => "Кейс создан. ".$CreateVersionResult['msg']
                ];
            } else if ($CreateVersionResult['status'] == false) {
                return [
                    "status" => true,
                    "error_msg" => $CreateVersionResult['error_msg']
                ];
            } else {
                return [
                    "status" => true,
                    "error_msg" => $CreateVersionResult
                ];
            }
            /*
            foreach ($steps as $step) {
                Steps::insert([
                    "Task_id" => $newTaskId,
                    "Step_Number" => $step['Step_Number'],
                    "Step_Action" => json_encode($step['Step_Action']),
                    "Step_Result" => json_encode($step['Step_Result'])
                ]);
            }
            return [
                "status" => "true",
                "msg" => "Кейс создан"
            ];*/
        } else {
            return [
                "status" => "false",
                "error_msg" => "При создании кейса произошла ошибка"
            ];
        }
    }

    /**
     *  Редактирование задачи - запись в БД
     *  @return JSON результата запроса
     */
    public function updateTask(Request $request) {
        if ($request->input("Task_isForRegress") == 1) {
            $request->validate([
                'Task_Name' => 'required|max:255',
                'Task_Priority' => 'required|max:255',
                'Task_Stage' => 'required|max:255',
                'Task_Project' => 'required|max:255',
            ]);
        } else {
            $request->validate([
                'Task_JiraProject' => 'required|max:255',
                'Task_Name' => 'required|max:255',
                'Task_Number' => 'required|max:255',
                'Task_Priority' => 'required|max:255',
                'Task_Stage' => 'required|max:255',
                'Task_Project' => 'required|max:255',
            ]);
        }
        $JiraProject = $request->input("Task_JiraProject");
        $Name = $request->input("Task_Name");
        $Number = $request->input("Task_Number");
        $Priority = $request->input("Task_Priority");
        $Stage = $request->input("Task_Stage");
        $Project = $request->input("Task_Project");
        $taskId = $request->input("Task_id");

            $result = Tasks::where('Task_id', $taskId)->update([
                'Task_JiraProject' => $JiraProject,
                'Task_Name' => $Name,
                'Task_Number' => $Number,
                'Task_Priority' => $Priority,
                'Task_Stage' => $Stage,
                'Task_Project' => $Project,
                'updated_at' => now()
            ]);
            if ($result === 1 || $result === true) {

                //Steps::where('Task_id', $taskId)->delete();
                //$steps = $request->input("steps");

                $CreateVersionResult = (new CaseVersionsController())->create($request);
                if ($CreateVersionResult['status'] == true) {
                    return [
                        "status" => true,
                        "msg" => "Кейс обновлен. " . $CreateVersionResult['msg']
                    ];
                } else if ($CreateVersionResult['status'] == false) {
                    return [
                        "status" => true,
                        "error_msg" => $CreateVersionResult['error_msg']
                    ];
                } else {
                    return [
                        "status" => true,
                        "error_msg" => $CreateVersionResult
                    ];
                }
            } else {
                return [
                    "status" => false,
                    "error_msg" => "При обновлении кейса произошла ошибка"
                ];
            }
    }

    public function changeActualVersion(Request $request) {
        $version = $request->input("version");
        $Task_id = $request->input("Task_id");
        $result = Tasks::where('Task_id', $Task_id)->update([
           'Task_ActualVersion' => $version
        ]);
        if ($result === 1 || $result === true) {
            return [
                "status" => true,
                "msg" => "Актуальная версия изменена"
            ];
        } else {
            return [
                "status" => false,
                "msg" => "Актуальная версия не изменена"
            ];
        }
    }
}
