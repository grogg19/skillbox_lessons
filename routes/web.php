<?php


use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TasksController::class, 'index'])->name('page.main');

Route::resource('tasks', 'TasksController');


Route::get('/about/', function () {
    return view('about');
})->name('page.about');
