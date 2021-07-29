<?php

namespace App\Http\Controllers;

use App\Models\Step;

class CompletedStepsController extends Controller
{
    /**
     * @param Step $step
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Step $step)
    {
        $step->complete();
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
