<?php

namespace App\Http\Controllers\api\v1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{

    public function getUsers() {
        return User::all();
    }

    public function index() {
        return Inertia::render('Users/Index', [
            'title' => 'Пользователи',
            'users' => User::paginate(10),
        ]);
    }

    /**
     *  Удаление пользователя
     *  @return Inertia object
     */
    public function destroy(Request $request) {
        $result = $this->deleteUser($request);
        return redirect()->back()->withErrors($result);
    }

    public function create() {
        return Inertia::render('Users/Create', [
            'title' => 'Добавить пользователя',
        ]);
    }

    /**
     *  Создание пользователя
     *  @return Inertia object
     */
    public function store(Request $request) {
        $result = $this->addUser($request);
        return redirect()->route('users')->withErrors($result);
    }

    /**
     * Редактировование пользователя (рендер страницы редактирования пользователя)
     */
    public function edit(Request $request) {
        $UserId = $request->input("User_id");
        $user = User::where('User_id', $UserId)->first();

        return Inertia::render('Users/Edit', [
            'title' => 'Редактирование пользователя',
            'user' => $user
        ]);
    }

    /**
     * Удаление пользователя
     * @return JSON
     */
    public function deleteUser(Request $request) {
        $id = $request->input("User_id");
        $result = User::where("User_id", $id)->delete();
        if ($result === 1) {
            return [
                "status" => "true",
                "msg" => "Пользователь удалён"
            ];
        } else {
            return [
                "status" => "false",
                "error_msg" => "При удалении пользователя произошла ошибка"
            ];
        }
    }

    /**
     *  Создание пользователя - запись в БД
     *  @return JSON результата запроса
     */
    public function addUser(Request $request) {
        $request->validate([
            'User_Name' => 'required|max:255',
            'User_Password' => 'required|max:255',
        ]);
        $userName = $request->input("User_Name");
        $userPassword = $request->input("User_Password");
        
        $isExist = User::where('User_Name', 'like', $userName)->get()->count();

        if ($isExist > 0) {
            return [
                "status" => "false",
                "msg" => "Пользователь не создан, имя использовано ранее"
            ];
        } else {
            $result = User::insert([
                'User_Name' => $userName,
                'User_Password' => $userPassword,
                'User_Role' => 1
            ]);
    
            if ($result === 1 || $result === true) {
                return [
                    "status" => "true",
                    "msg" => "Пользователь создан"
                ];
            } else {
                return [
                    "status" => "false",
                    "error_msg" => "При создании пользователя произошла ошибка"
                ];
            }
        }
    }


    /**
     *  Редактирование пользователя
     *  @return Inertia object
     */
    public function update(Request $request) {
        $result = $this->updateUser($request);

        return redirect()->route('users')->withErrors($result);
    }


    /**
     *  Редактирование пользователя - запись в БД
     *  @return JSON результата запроса
     */
    public function updateUser(Request $request) {
        $UserName = $request->input("User_Name");
        $UserPassword = $request->input("User_Password");
        $UserRole = $request->input("User_Role");
        $UserId = $request->input("User_id");
        $isExist = User::where('User_Name', 'like', $UserName)->where('User_id', 'not', $UserId)->get()->count();
        if ($isExist > 0) {
            return [
                "status" => "false",
                "msg" => "Пользователь с таким именем уже существует"
            ];
        } else {
            $request->validate([
                'User_Name' => 'required|max:255',
                'User_Password' => 'required|max:255',
            ]);
            $result = User::where('User_id', $UserId)->update([
                'User_Name' => $UserName,
                'User_Password' => $UserPassword,
                'User_Role' => $UserRole,
            ]);
            if ($result === 1 || $result === true) {
                return [
                    "status" => "true",
                    "msg" => "Пользователь отредактирован"
                ];
            } else {
                return [
                    "status" => "false",
                    "error_msg" => "При редактировании пользователя произошла ошибка"
                ];
            }
        }
    }
}
