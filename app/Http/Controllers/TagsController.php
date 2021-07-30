<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {

        //dd($tag->tasks);
        $tasks = $tag->tasks()->with('tags')->get();

        return view('index', compact('tasks'));
    }
}
