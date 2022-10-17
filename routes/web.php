<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->middleware(['auth'])->name('dashboard.default');
Route::get('/dashboard', [\App\Http\Controllers\HomeController::class,'index'])->middleware(['auth'])->name('dashboard');
Route::get('/getDataGraph',[\App\Http\Controllers\HomeController::class,'getDataGraph'])->name('getDataGraph ')->middleware('auth');
Route::get('/project',[\App\Http\Controllers\ProjectController::class,'index'])->name('project ')->middleware('auth');
Route::post('/project',[\App\Http\Controllers\ProjectController::class,'store'])->name('project.store ')->middleware('auth');
Route::get('/project/create',[\App\Http\Controllers\ProjectController::class,'create'])->name('project ')->middleware('auth');
Route::put('/project/{project:id}',[\App\Http\Controllers\ProjectController::class,'update'])->name('project.update ')->middleware('auth');
Route::get('/project/{project:id}',[\App\Http\Controllers\ProjectController::class,'edit'])->name('project.update ')->middleware('auth');
Route::delete('/project/{project:id}',[\App\Http\Controllers\ProjectController::class,'delete'])->name('project.delete ')->middleware('auth');
Route::get('/project/getProjectNote/{project:id}',[\App\Http\Controllers\ProjectController::class,'getProjectNote'])->name('project.get-project-note ')->middleware('auth');
Route::get('/export',[\App\Http\Controllers\ExportController::class,'export'])->name('export')->middleware(['auth']);

Route::get('/getProjectType',[\App\Http\Controllers\SettingController::class,'getProjectType'])->middleware('auth');
Route::get('/getSponsorByOwner',[\App\Http\Controllers\ProjectController::class,'getSponsorByOwner'])->middleware('auth');
require __DIR__.'/auth.php';
