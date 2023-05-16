<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\v1\UserController;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function login(LoginFormRequest $request): RedirectResponse
    {
        if(!auth()->attempt($request->validated())) {
            return redirect()
                ->route('login')
                ->withErrors(['email' => 'Пользователь не найден, либо данные введены не верно']);
        } else {
            $user = (new UserController)->getUserByEmail($request);
            $request->session()->put('user', $user);
            if ($request->input('PrefProjectId') && $request->input('PrefProjectId') !== null) {
                $PrefProjectId = $request->input('PrefProjectId');
                $request->request->set('Project_id', $PrefProjectId);
                (new api\v1\ProjectController())->setPrefProject($request);
            }
            return redirect()->route('home');
        }

    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('home');
    }
}
