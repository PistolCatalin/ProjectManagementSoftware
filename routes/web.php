<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('projects');
// });
Route::get('users/{index-filtering}', [App\Http\Controllers\UserController::class, 'indexFiltering']);
Route::put('/editUser/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('edituser');
Route::get('/', [App\Http\Controllers\TasksController::class, 'index'])->name('home');
Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('projects');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::resource('projects', ProjectController::class);
Route::resource('tasks', TasksController::class);
Route::post('tasks/changeStatus', [TasksController::class, 'updateStatus'])->name('tasks.updateStatus');;
Route::resource('comments', CommentsController::class);
Route::get('/adduser', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('adduser');
Route::post('/adduser', [App\Http\Controllers\UserController::class, 'store']);
Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
