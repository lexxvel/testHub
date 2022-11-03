<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function getProjects() {
        return Project::all();
    }

    public function index() {
        return Inertia::render('Projects/Index', [
            'title' => 'Проекты',
            'projects' => Project::all(),
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
        $projectId = $request->input("Project_id");
        $project = Project::where('Project_id', $projectId)->first();

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
     *  @return JSON результата запроса
     */
    public function addProject(Request $request) {
        $request->validate([
            'Project_Name' => 'required|max:255',
            'Project_About' => 'max:255',
        ]);
        $projectName = $request->input("Project_Name");
        $projectAbout = $request->input("Project_About");
        $projectIsCommon = $request->input("Project_isCommon");

        $isExist = Project::where('Project_Name', 'like', $projectName)->get()->count();

        if ($isExist > 0) {
            return [
                "status" => "false",
                "msg" => "Проект не создан, название использовано ранее"
            ];
        } else {

            $result = Project::insert([
                'Project_Name' => $projectName,
                'Project_About' => $projectAbout,
                'Project_isCommon' => $projectIsCommon,
                'created_at' => now()
            ]);

            if ($result === 1 || $result === true) {
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
        ]);
        $projectName = $request->input("Project_Name");
        $projectAbout = $request->input("Project_About");
        $projectIsCommon = $request->input("Project_isCommon");
        $projectId = $request->input("Project_id");
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
}
