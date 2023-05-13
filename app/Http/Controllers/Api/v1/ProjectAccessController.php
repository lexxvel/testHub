<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\ProjectAccess;
use Illuminate\Http\Request;

class ProjectAccessController extends Controller
{

    /**
     * Установка доступа пользователю
     * @param Request $request Должен включать Project_id и User_id
     * @return array
     */
    public function addAccess(Request $request) : array
    {
        $Project_id = $request->input("Project_id");
        $User_id = $request->input("User_id");
        return (new ProjectAccess())->addAccess($User_id, $Project_id);
    }

    /**
     * Удаление доступа из проекта
     * @param Request $request Должен включать Project_id и User_id
     * @return array
     */
    public function delAccess(Request $request) : array
    {
        $Project_id = $request->input("Project_id");
        $User_id = $request->input("User_id");
        return (new ProjectAccess())->delAccess($User_id, $Project_id);
    }
}
