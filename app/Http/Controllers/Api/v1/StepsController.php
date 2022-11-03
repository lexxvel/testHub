<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Steps;

class StepsController extends Controller
{
    public function store(Request $request) {
        $steps = $request->input["steps"];
        foreach ($steps as $step) {
            dd($step);
        }
    }

    public function getStepsByTask(Request $request) {
        $TaskId = $request->input("Task_id");
        return Steps::where("Task_id", $TaskId)->orderBy("Step_Number")->get();
    }
}
