<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskStepsController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $attributes = $request->validate([
           'description' => 'required|min:5'
        ]);
        $task->addStep($attributes);
        return back();
    }
}
