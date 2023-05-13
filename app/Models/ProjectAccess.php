<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProjectAccess extends Model
{
    use HasFactory;

    /**
     * Добавление доступа пользователю к проекту
     * @param $User_id     integer идентификатор пользователя
     * @param $Project_id  integer идентификатор проекта
     * @return             array   ответ
     */
    public function addAccess($User_id, $Project_id) : array
    {
        if ($User_id && $Project_id) {

            $exists = DB::table("project_accesses")
                ->where('User_id', $User_id)
                ->where('Project_id', $Project_id)
                ->get()->count();

            if ($exists == 0) {
                $res = DB::table("project_accesses")->insert([
                    'User_id' => $User_id,
                    'Project_id' => $Project_id,
                    'created_at' => Carbon::now()
                ]);
                if ($res == 1) {
                    return [
                        'success' => true,
                        'error_msg' => 'Пользователь добавлен в проект'
                    ];
                } else {
                    return [
                        'success' => false,
                        'error_msg' => 'При создании доступа в проект произошла ошибка'
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'error_msg' => 'Доступ к проекту у этого пользователя уже существует'
                ];
            }
        } else {
            return [
                'success' => false,
                'error_msg' => 'Не переданы обязательные параметры'
            ];
        }
    }

    /**
     * Удаление доступа из проекта
     * @param $User_id     integer идентификатор пользователя
     * @param $Project_id  integer идентификатор проекта
     * @return             array   ответ
     */
    public function delAccess(int $User_id, int $Project_id) : array
    {
        if ($User_id && $Project_id) {
            $res = DB::table("project_accesses")
                ->where('User_id', $User_id)
                ->where('Project_id', $Project_id)
                ->delete();
            if ($res == 1) {
                return [
                    'success' => true,
                    'error_msg' => 'Пользователь удален из проекта'
                ];
            } else {
                return [
                    'success' => false,
                    'error_msg' => 'При удалении доступа в проект произошла ошибка'
                ];
            }
        } else {
            return [
                'success' => false,
                'error_msg' => 'Не переданы обязательные параметры'
            ];
        }
    }

    /**
     * Удаление доступа из проекта всем пользователям.
     * @param $Project_id
     * @return array
     */
    public function delAddAccess($Project_id) : array
    {
        if ($Project_id) {
            DB::table('project_accesses')->where('Project_id', $Project_id)->delete();
            return [
                'success' => true,
                'error_msg' => 'Пользователи удалены из проекта'
            ];
        } else {
            return [
                'success' => false,
                'error_msg' => 'Не переданы обязательные параметры'
            ];
        }
    }


    public function getProjectsByAccess ($User_id)
    {
        if ($User_id) {
            $res1 = DB::table('projects')->where('Project_isCommon', '=', 1);
            return DB::table('project_accesses')
                ->join('projects', 'projects.Project_id', '=', 'project_accesses.Project_id')
                ->where('project_accesses.User_id', $User_id)
                ->select('projects.*')
                ->union($res1)
                ->get();
        } else {
            return [
                'success' => false,
                'error_msg' => 'Не переданы обязательные параметры'
            ];
        }
    }
}
