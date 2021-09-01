<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagsRequest;
use App\Models\Task;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($perPage = 10)
    {
        if (auth()->check()) {
            $tasks = auth()->user()->tasks()->with('tags')->latest()->paginate($perPage);
        } else {
            $tasks = Task::with('tags')->latest()->paginate($perPage);
        }

        return view('index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param TagsSynchronizer $tagsSynchronizer
     * @param TagsRequest $tagsRequest
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, TagsSynchronizer $tagsSynchronizer, TagsRequest $tagsRequest)
    {

        $rules = [
            'title' => 'required',
            'body' => 'required'
        ];

        $attributes = $request->validate($rules);

        $attributes['owner_id'] = auth()->id();

        $task = Task::create($attributes);

        $tags = $tagsRequest->getTags($request);

        $tagsSynchronizer->sync($tags, $task);

        return redirect(route('page.main'));
    }

    /**
     * Display the specified resource.
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Task $task, TagsSynchronizer $tagsSynchronizer, TagsRequest $tagsRequest)
    {
        $rules = [
            'title' => 'required',
            'body' => 'required'
        ];
        $attributes = $request->validate($rules);

        $task->update($attributes);

        $tags = $tagsRequest->getTags($request);

        $tagsSynchronizer->sync($tags, $task);

        return redirect(route('page.main'));
    }

    /**
     * Remove the specified resource from storage.
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect(route('page.main'));
    }
}
