<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TasksController::class, 'index'])->name('page.main');
Route::get('/tasks/create', 'TasksController@create')->name('task.create');
Route::post('/tasks/store', 'TasksController@store')->name('task.save');
Route::get('/tasks/{id}', 'TasksController@show')->name('task.show');

Route::get('/about/', function () {
    return view('about');
})->name('page.about');
