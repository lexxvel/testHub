<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'title' => 'TestHub'
        ]);
    }

    public function login()
    {
        return Inertia::render('Login', [
            'title' => 'Войти'
        ]);
    }
}
