<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;

class TaskStepsController extends Controller
{
    public function update(Request $request, Step $step)
    {
        $step->update(['completed' => $request->boolean('completed')]);

        return redirect(route('tasks.show', ['task' => $step->task->id]));
    }
}
