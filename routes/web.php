<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ToDoListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/addtask/{id} ', [TaskController::class, 'index']);
Route::get('/editTask/{id} ', [TaskController::class, 'edit']);
Route::get('/deleteTask/{id} ', [TaskController::class, 'delete']);
Route::get('/addPlan/{id} ', [TaskController::class, 'addToPlan']);

Route::get('/listadd', [ToDoListController::class, 'index'])->name('list');
Route::get('/editList/{id} ', [ToDoListController::class, 'edit']);
Route::get('/deleteList/{id} ', [ToDoListController::class, 'delete']);

Route::post('/listStore', [ToDoListController::class, 'store']);
Route::post('/listUpdate', [ToDoListController::class, 'update']);

Route::post('/taskStore', [TaskController::class, 'store']);
Route::post('/taskUpdate', [TaskController::class, 'update']);
Route::post('/task/{id}/complete', [TaskController::class, 'isComplete']);
Route::post('/planUpdate', [TaskController::class, 'updatePlan']);