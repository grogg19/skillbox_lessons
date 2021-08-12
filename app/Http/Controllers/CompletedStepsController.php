<?php

namespace App\Http\Controllers;

use App\Models\Step;
use App\Notifications\TaskStepCompleted;

class CompletedStepsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Step $step
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Step $step)
    {
        $step->complete();

        $step->task->owner->notify(new TaskStepCompleted());

        return back();
    }

    /**
     * @param Step $step
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Step $step)
    {
        $step->incomplete();
        return back();
    }
}
