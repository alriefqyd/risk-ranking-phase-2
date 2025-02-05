<?php

use App\Models\TemporaryFile;
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
Route::get('/project/year/{year}',[\App\Http\Controllers\ProjectController::class,'index'])->name('project.year ')->middleware('auth');
Route::post('/project',[\App\Http\Controllers\ProjectController::class,'store'])->name('project.store ')->middleware('auth');
Route::post('/project/duplicate',[\App\Http\Controllers\ProjectController::class,'duplicate'])->name('project.duplicate ')->middleware('auth');
Route::post('/update-investment-strategy',[\App\Http\Controllers\ProjectController::class,'updateInvestmentStrategy'])->name('project.update-investment ')->middleware('auth');
Route::get('/project/create',[\App\Http\Controllers\ProjectController::class,'create'])->name('project.create ')->middleware('auth');
Route::put('/project/{project:id}',[\App\Http\Controllers\ProjectController::class,'update'])->name('project.update ')->middleware('auth');
Route::put('/project/note-status/{project:id}',[\App\Http\Controllers\ProjectController::class,'updateNoteStatus'])->name('project.update ')->middleware('auth');
Route::get('/project/{project:id}',[\App\Http\Controllers\ProjectController::class,'show'])->name('project.show ')->middleware('auth');
Route::delete('/project/{project:id}',[\App\Http\Controllers\ProjectController::class,'delete'])->name('project.delete ')->middleware('auth');
Route::get('/getProjectNote/{id}',[\App\Http\Controllers\ProjectController::class,'getProjectNote'])->name('project.get-project-note ')->middleware('auth');
Route::get('/export/{year}',[\App\Http\Controllers\ExportController::class,'export'])->name('export')->middleware(['auth']);
Route::post('/budget-tool',[\App\Http\Controllers\ProjectController::class,'storeBudgetTool'])->middleware(['auth']);


Route::post('/assessment',[\App\Http\Controllers\AssessmentController::class,'store'])->middleware('auth');
Route::get('/assessment',[\App\Http\Controllers\AssessmentController::class,'index'])->middleware('auth');
Route::put('/assessment/{project:id}',[\App\Http\Controllers\AssessmentController::class,'update'])->middleware('auth');

Route::get('/fel1',[\App\Http\Controllers\Fel1Controller::class,'index'])->middleware('auth');
Route::post('/fel1',[\App\Http\Controllers\Fel1Controller::class,'store'])->middleware('auth');
Route::put('/fel1/{project:id}',[\App\Http\Controllers\Fel1Controller::class,'update'])->middleware('auth');

Route::get('/fel2',[\App\Http\Controllers\Fel2Controller::class,'index'])->middleware('auth');
Route::post('/fel2',[\App\Http\Controllers\Fel2Controller::class,'store'])->middleware('auth');
Route::put('/fel2/{project:id}',[\App\Http\Controllers\Fel2Controller::class,'update'])->middleware('auth');

Route::get('/fel3',[\App\Http\Controllers\Fel3Controller::class,'index'])->middleware('auth');
Route::post('/fel3',[\App\Http\Controllers\Fel3Controller::class,'store'])->middleware('auth');
Route::put('/fel3/{project:id}',[\App\Http\Controllers\Fel3Controller::class,'update'])->middleware('auth');

Route::get('/business-case',[\App\Http\Controllers\BusinessCaseAssessmentController::class,'index'])->middleware('auth');
Route::post('/business-case',[\App\Http\Controllers\BusinessCaseAssessmentController::class,'store'])->middleware('auth');
Route::put('/business-case/{project:id}',[\App\Http\Controllers\BusinessCaseAssessmentController::class,'update'])->middleware('auth');

Route::get('/setSession',[\App\Http\Controllers\SettingController::class,'setSession'])->middleware('auth');
Route::get('/getProjectType',[\App\Http\Controllers\SettingController::class,'getProjectType'])->middleware('auth');
Route::get('/getSponsorByOwner',[\App\Http\Controllers\ProjectController::class,'getSponsorByOwner'])->middleware('auth');
Route::get('/getSubDepartment',[\App\Http\Controllers\ProjectController::class,'getSubDepartment'])->middleware('auth');
Route::get('/getProjectOwner',[\App\Http\Controllers\ProjectController::class,'getDepartmentByDirectorate'])->middleware('auth');

Route::post('/cost_benefit',[\App\Http\Controllers\CostBenefitController::class,'store'])->name('cost_benefit_post')->middleware(['auth']);

Route::get('/preview',[\App\Http\Controllers\DocumentController::class,'preview'])->name('preview_document')->middleware(['auth']);
Route::post('/markNotification', [\App\Http\Controllers\ProjectController::class,'markNotification'])->name('notif')->middleware(['auth']);

Route::get('/preview-export',[\App\Http\Controllers\ProjectController::class,'previewExport'])->name('preview_export')->middleware(['auth']);

Route::get('/getSubBasketByBasket', [\App\Http\Controllers\CapexInvestmentController::class, 'getSubBasketByBasket'])->middleware(['auth']);
Route::get('/getCategoriesBySubBasket', [\App\Http\Controllers\CapexInvestmentController::class, 'getCategoriesBySubBasket'])->middleware(['auth']);
Route::get('/getProjectByOperationArea', [\App\Http\Controllers\ProjectController::class, 'getProjectByOperation'])->middleware(['auth']);
Route::get('/getProjectByOperationSubmitted', [\App\Http\Controllers\ProjectController::class, 'getProjectByOperationSubmitted'])->middleware(['auth']);

Route::post('upload',[\App\Http\Controllers\DocumentController::class,'store'])->name('upload')->middleware(['auth']);
Route::put('upload/update',[\App\Http\Controllers\DocumentController::class,'update'])->name('update')->middleware(['auth']);
Route::delete('upload/cancel', [\App\Http\Controllers\DocumentController::class, 'cancel'])->name('cancel')->middleware(['auth']);

require __DIR__.'/auth.php';
