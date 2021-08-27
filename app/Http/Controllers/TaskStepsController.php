<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagsRequest;
use App\Models\Task;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;

class TaskStepsController extends Controller
{
    public function store(Request $request, Task $task, TagsSynchronizer $tagsSynchronizer, TagsRequest $tagsRequest)
    {
        $attributes = $request->validate([
           'description' => 'required|min:5'
        ]);
        $step = $task->addStep($attributes);

        $tags = $tagsRequest->getTags($request);

        $tagsSynchronizer->sync($tags, $step);

        return back();
    }
}
