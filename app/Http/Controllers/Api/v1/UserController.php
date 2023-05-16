<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Inertia;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{

    public function getUsers() {
        return User::all();
    }

    public function getUserByEmail(Request $request) {
        $email = $request->input('email');
        return User::where('email', $email)->first();
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

    public function createUser(Request $request) {
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);
        $email = $request->input("email");
        $role = $request->input("User_Role");

        Crypt::encryptString($request->input("password"));

        $userPassword = $request->input("password");

        $isExist = (new User)->isUserExists($email);
        //$isExist = User::where('email', 'like', $email)->get()->count();

        if ($isExist) {
            return [
                "status" => "false",
                "msg" => "Пользователь не создан, имя использовано ранее"
            ];
        } else if (!$isExist) {
            return (new User)->createUser($email, bcrypt($userPassword), $role);
        } else {
            return [
                "status" => "false",
                "msg" => "Пользователь не создан. Произошла ошибка"
            ];
        }
    }

    /**
     *  Создание пользователя
     *  @return Inertia object
     */
    public function store(Request $request) {
        $result = $this->createUser($request);
        return redirect()->route('users')->withErrors($result);
    }

    /**
     * Редактировование пользователя (рендер страницы редактирования пользователя)
     */
    public function edit(Request $request) {
        $UserId = $request->input("id");
        $user = User::where('id', $UserId)->first();

        return Inertia::render('Users/Edit', [
            'title' => 'Редактирование пользователя',
            'editUser' => $user
        ]);
    }

    /**
     * Удаление пользователя
     * @return JSON
     */
    public function deleteUser(Request $request) {
        $id = $request->input("id");
        $result = User::where("id", $id)->delete();
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
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);
        $userName = $request->input("email");

        Crypt::encryptString($request->input("password"));

        $userPassword = $request->input("password");
        $cryptedUserPassword = bcrypt($userPassword);

        $isExist = User::where('email', 'like', $userName)->get()->count();

        if ($isExist > 0) {
            return [
                "status" => "false",
                "msg" => "Пользователь не создан, имя использовано ранее"
            ];
        } else {

            $result = User::insert([
                'email' => $userName,
                'password' => $cryptedUserPassword,
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
        $UserName = $request->input("email");
        $UserRole = $request->input("User_Role");
        $password = $request->input("password");
        $UserId = $request->input("id");
        $isExist = User::where('email', 'like', $UserName)->where('id', 'not', $UserId)->get()->count();
        if ($isExist > 0) {
            return [
                "status" => "false",
                "msg" => "Пользователь с таким именем уже существует"
            ];
        } else {
            $request->validate([
                'email' => 'required|max:255',
                'password' => 'required|max:255'
            ]);
            $result = User::where('id', $UserId)->update([
                'email' => $UserName,
                'password' => bcrypt($password),
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
