<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag, $perPage = 10)
    {

        $tasks = $tag->tasks()->with('tags')->paginate($perPage);

        return view('index', compact('tasks'));
    }
}
