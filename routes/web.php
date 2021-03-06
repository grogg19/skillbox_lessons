<?php

use App\Events\ChatMessage;
use App\Http\Controllers\PushServiceController;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TaskStepsController;
use App\Http\Controllers\CompletedStepsController;

Route::get('/', [TasksController::class, 'index'])->name('page.main');

Route::get('/test', function () {
    dump(getRange([9,3,5,4,6,12,11,10,1,14,15]));
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

Route::post('/chat', function () {
    broadcast(new ChatMessage(request('message'), auth()->user()))->toOthers();
})->middleware('auth');

require __DIR__.'/auth.php';
