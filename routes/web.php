<?php


use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TasksController::class, 'index'])->name('page.main');

Route::resource('tasks', 'TasksController');

Route::patch('/steps/{step}', 'TaskStepsController@update')->name('task.step.update');

Route::get('/about/', function () {
    return view('about');
})->name('page.about');
