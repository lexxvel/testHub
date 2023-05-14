<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Models\ProjectAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Js;
use Inertia\Inertia;
use Psy\Util\Json;
use Ramsey\Uuid\Type\Integer;

class ProjectController extends Controller
{
    public function getProjects(Request $request) {
        $User_id = $request->session()->get('user')->id;
        $User_Role = $request->session()->get('user')->User_Role;
        if ($User_Role == 99) {
            return Project::all();
        } else {
            return $this->getProjectsByAccess($request);
        }
    }

    public function getProjectsByAccess(Request $request)
    {
        $User_id = $request->session()->get('user')->id;
        return (new ProjectAccess)->getProjectsByAccess($User_id);
    }

    public function index(Request $request) {
        return Inertia::render('Projects/Index', [
            'title' => 'Проекты',
            'projects' => $this->getProjects($request),
        ]);
    }

    public function create() {
        return Inertia::render('Projects/Create', [
            'title' => 'Добавить проект',
        ]);
    }

    /**
     *  Создание проекта
     *  @return Inertia object
     */
    public function store(Request $request) {
        $result = $this->addProject($request);
        return redirect()->route('projects')->withErrors($result);
    }

    /**
     *  Удаление проекта
     *  @return Inertia object
     */
    public function destroy(Request $request) {
        $result = $this->deleteProject($request);
        return redirect()->back()->withErrors($result);
    }

    /**
     * Редактировование проекта (рендер страницы редактирования проекта)
     */
    public function edit(Request $request) {
        //$projectId = $request->input("Project_id");
        $project = $this->getProject($request);

        return Inertia::render('Projects/Edit', [
            'title' => 'Редактирование проекта',
            'project' => $project
        ]);
    }

    /**
     *  Редактирование проекта
     *  @return Inertia object
     */
    public function update(Request $request) {
        $result = $this->updateProject($request);

        return redirect()->route('projects')->withErrors($result);
    }

    /**
     * Получение проекта
     * @param Request $request должен содержать Project_id
     * @return array
     */
    public function getProject(Request $request): array
    {
        $Project_id = $request->input("Project_id");
        if ($Project_id) {
            return (new Project)->getProject($Project_id);
        } else {
            return [
                "success" => false,
                "msg" => "Проект не найден"
            ];
        }
    }


    /**
     * Удаление проекта
     * @return JSON
     */
    public function deleteProject(Request $request) {
        $projectId = $request->input("Project_id");
        $result = Project::where("Project_id", $projectId)->delete();
        if ($result === 1) {
            return [
                "status" => "true",
                "msg" => "Проект удалён"
            ];
        } else {
            return [
                "status" => "false",
                "error_msg" => "При удалении проекта произошла ошибка"
            ];
        }
    }


    /**
     *  Создание проекта - запись в БД
     *  @return array результата запроса
     */
    public function addProject(Request $request) : array
    {
        $request->validate([
            'Project_Name' => 'required|max:255',
            'Project_About' => 'max:255',
        ]);
        $projectName = $request->input("Project_Name");
        $projectAbout = $request->input("Project_About");
        $projectIsCommon = $request->input("Project_isCommon");
        $users = $request->input("users");

        $isExist = Project::where('Project_Name', 'like', $projectName)->get()->count();

        if ($isExist > 0) {
            return [
                "status" => "false",
                "msg" => "Проект не создан, название использовано ранее"
            ];
        } else {
            $defaultTree = '{"id": 0,"name": "Проект","id_counter": 4,"root": true, "children":[{ "id": 1, "name": "Текучка", "root": true },{ "id": 2, "name": "Архив", "root": true },{ "id": 3, "name": "Регресс", "root": true }]}';
            $result = Project::insert([
                'Project_Name' => $projectName,
                'Project_About' => $projectAbout,
                'Project_isCommon' => $projectIsCommon,
                'created_at' => now(),
                'Project_CasesTree' => $defaultTree
            ]);
            if ($result === 1 || $result === true) {
                if (!$projectIsCommon || $projectIsCommon == 0) {
                    $Project_id = Project::where('Project_Name', 'like', $projectName)
                        ->orderBy('Project_id', 'DESC')
                        ->first()->Project_id;

                    foreach ($users as $user) {
                        $accessAddRes = (new ProjectAccess)->addAccess(Arr::get($user, 'id'), $Project_id);
                        if (Arr::get($accessAddRes, 'success') == false) {
                            return [
                                "status" => "true",
                                "error_msg" => "Проект создан, но при добавлении пользователей произошла ошибка"
                            ];
                        }
                    }
                }
                return [
                    "status" => "true",
                    "msg" => "Проект создан"
                ];
            } else {
                return [
                    "status" => "false",
                    "error_msg" => "При создании проекта произошла ошибка"
                ];
            }
        }
    }

    /**
     *  Редактирование проекта - запись в БД
     *  @return JSON результата запроса
     */
    public function updateProject(Request $request) {
        $request->validate([
            'Project_Name' => 'required|max:255',
            'Project_About' => 'max:255',
            'Project_isCommon' => 'required',
        ]);
        $projectName = $request->input("Project_Name");
        $projectAbout = $request->input("Project_About");
        $projectIsCommon = $request->input("Project_isCommon");
        $projectId = $request->input("Project_id");
        $users = $request->input("users");

        //поиск проекта с таким же именем
        $isExist = Project::where('Project_Name', 'like', $projectName)->where('Project_id', 'not', $projectId)->get()->count();

        if ($isExist > 0) {
            return [
                "status" => "false",
                "msg" => "Проект с таким именем уже существует"
            ];
        } else {
            $result = Project::where('Project_id', $projectId)->update([
                'Project_Name' => $projectName,
                'Project_About' => $projectAbout,
                'Project_isCommon' => $projectIsCommon
            ]);
            if (!$projectIsCommon) {
                foreach ($users as $user) {
                    (new ProjectAccess)->addAccess(Arr::get($user, 'id'), $projectId);
                }
            } else {
                (new ProjectAccess)->delAddAccess($projectId);
            }

            if ($result === 1 || $result === true) {
                return [
                    "status" => "true",
                    "msg" => "Проект обновлен"
                ];
            } else {
                return [
                    "status" => "false",
                    "error_msg" => "При редактировании проекта произошла ошибка"
                ];
            }
        }
    }

    /**
     * Установка избранного проекта
     *
     * @param Request $request
     */
    public function setPrefProject(Request $request) {
        $prefProject = $request->request->get('Project_id');
        $curProject = $request->session()->get('prefProject');
        if ($curProject == null) {
            $request->session()->put('prefProject', $prefProject);
        } else {
            $request->session()->put('prefProject', $prefProject);
        }
    }

    /**
     * Установка избранного проекта
     *
     * @param Request $request
     * @return string Дерево проекта
     */
    public function getProjectTree(Request $request): string
    {
        $Project_id = $request->input("Project_id");
        return Project::where('Project_id', $Project_id)->first()->Project_CasesTree;
    }

    public function updateTree(Request $request) {
        $Project_id = (int) $request->input("Project_id");
        $tree = $request->input("tree");
        return (new Project)->updateTree($Project_id, $tree);
    }
}
