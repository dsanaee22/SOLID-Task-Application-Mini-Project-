<?php

use Illuminate\Support\Facades\Route;
use TaskApp\Controllers\Response\Controllers\ShowCreateController;
use TaskApp\Controllers\Response\Controllers\TaskCrudResponseController;
use TaskApp\Controllers\TaskController;
use TaskApp\Controllers\TaskDeleteController;
use TaskApp\Controllers\TaskEditController;
use TaskApp\Controllers\TaskStoreController;
use TaskApp\Controllers\TaskUpdateController;

//Route::group(['namespace' => 'App\Http\Controllers'], function() {
//    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//    Route::post('login', 'Auth\LoginController@login');
//    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//    Route::post('register', 'Auth\RegisterController@register');
//});


Route::jsonWidget('/api/tasks/select-box/', 'StateWidget', 'JsonStateWidget');

Route::view('tasks/index', 'Task::index')->name('tasks.index');
Route::get('tasks/create', fn() => TaskCrudResponseController::showCreateForm())->name('task.create');

Route::get('tasks/{task}/edit', [TaskEditController::class, 'edit'])->name('task.edit');

Route::post('tasks/', [TaskStoreController::class, 'store'])->name('task.store');

Route::put('tasks/{task}', [TaskUpdateController::class, 'update'])->name('task.update');

Route::delete('tasks/{task}', [TaskDeleteController::class, 'destroy'])->name('task.destroy');
