<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory;

    /**
     * Обновление дерева проекта.
     * @param $Project_id int    id проекта
     * @param $tree       string дерево
     * @return            array  ответ
     */
    public function updateTree (int $Project_id, string $tree) : array
    {
        if ($Project_id || $tree) {
            $res = DB::table('projects')->where('Project_id', $Project_id)
                ->update([
                'Project_CasesTree' => $tree
            ]);
            if ($res == 1) {
                $newTree = DB::table('projects')
                    ->select('Project_CasesTree')
                    ->where('Project_id', $Project_id)
                    ->first();
                return [
                    "status" => true,
                    "error_msg" => 'Дерево проекта успешно обновлено',
                    "tree" => $newTree
                ];
            } else {
                return [
                    "status" => false,
                    "error_msg" => 'Ошибка при обновлении дерева проекта'
                ];
            }
        } else {
            return [
              "status" => false,
              "error_msg" => 'Не передан обязательный параметр'
            ];
        }
    }
}
