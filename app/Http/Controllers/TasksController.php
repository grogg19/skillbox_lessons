<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $tasks = Task::with('tags')->latest()->get();
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'body' => 'required'
        ];


        $attibutes = $request->validate($rules);

        Task::create($attibutes);

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
    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Task $task)
    {
        $rules = [
            'title' => 'required',
            'body' => 'required'
        ];
        $attributes = $request->validate($rules);

        $task->update($attributes);

        /** @var Collection $taskTags */
        $taskTags = $task->tags->keyBy('name');

        // теги с формы
        $tags = collect(explode(',', $request->post('tags')))->keyBy(function ($item) { return $item; });

        // ids для метода sync()
        $syncIds = $taskTags->intersectByKeys($tags)->pluck('id')->toArray();

        $tagsToAttach = $tags->diffKeys($taskTags);

        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $task->tags()->sync($syncIds);

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
