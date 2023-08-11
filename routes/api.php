<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\StudyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[UserController::class ,'login'])->name('login');
Route::post('/signUp',[UserController::class,'sign_up']);
Route::post('/verification',[UserController::class,'verification']);
Route::post('/register',[UserController::class,'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
// private reference routes
    Route::get('/reference', [ReferenceController::class, 'show']);
    Route::post('/reference', [ReferenceController::class, 'store']);
    Route::put('/reference/{id}', [ReferenceController::class, 'update']);
    Route::delete('/reference/{id}', [ReferenceController::class, 'destroy']);
// private chapter routes
    Route::get('/chapter', [ChapterController::class, 'show']);
    Route::post('/chapter', [ChapterController::class, 'store']);
    Route::put('/chapter/{id}', [ChapterController::class, 'update']);
    Route::delete('/chapter/{id}', [ChapterController::class, 'destroy']);
// private study routes
    Route::get('/study', [StudyController::class, 'show']);
    Route::post('/study', [StudyController::class, 'store']);
    Route::put('/study/{id}', [StudyController::class, 'update']);
    Route::delete('/study/{id}', [StudyController::class, 'destroy']);
// logout
    Route::post('/logout', [UserController::class, 'logout']);
});



