<?php

use App\Http\Controllers\PushServiceController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TaskStepsController;
use App\Http\Controllers\CompletedStepsController;

Route::get('/', [TasksController::class, 'index'])->name('page.main');

Route::get('/test', function (){
    $tasks = DB::table('tasks')
        ->where('options->lang', 'ru')
        ->get();

    dump($tasks);
});
Route::get('/tasks/tags/{tag}', [TagsController::class, 'index'])->name('tags.selectByTag');

Route::resource('tasks', 'TasksController');

Route::post('/tasks/{task}/steps', [TaskStepsController::class, 'store'])->name('task.step.store');
Route::post('/completed-steps/{step}', [CompletedStepsController::class, 'store']);
Route::delete ('/completed-steps/{step}', [CompletedStepsController::class, 'destroy']);

Route::get('/about/', function () {
    return view('about');
})->name('page.about');

Route::post('/companies', function () {
    auth()->user()->company()->create(request()->validate(['name' => 'required']));
})->middleware('auth');

Route::get('/service', [PushServiceController::class, 'form'])->name('pushall.form');
Route::post('/service', [PushServiceController::class, 'send'])->name('pushall.send');

require __DIR__.'/auth.php';
