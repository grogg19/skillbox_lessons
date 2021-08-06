<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TaskStepsController;
use App\Http\Controllers\CompletedStepsController;

Route::get('/', [TasksController::class, 'index'])->name('page.main');

Route::get('/tasks/tags/{tag}', [TagsController::class, 'index'])->name('tags.selectByTag');

Route::resource('tasks', 'TasksController');

Route::post('/tasks/{task}/steps', [TaskStepsController::class, 'store'])->name('task.step.store');
Route::post('/completed-steps/{step}', [CompletedStepsController::class, 'store']);
Route::delete ('/completed-steps/{step}', [CompletedStepsController::class, 'destroy']);

Route::get('/about/', function()   {
    return view('about');
})->name('page.about');

require __DIR__.'/auth.php';
