<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login',[LoginController::class,'login']);

Route::middleware('auth:api')->group(function(){
    Route::group(['prefix' => 'user'],function(){
        Route::get('list',[UserController::class,'list']);
        Route::post('add',[UserController::class,'add']);
        Route::post('edit',[UserController::class,'edit']);
        Route::post('update',[UserController::class,'update']);
        Route::post('delete',[UserController::class,'delete']);
    });

    Route::group(['prefix' => 'survey'],function(){
        Route::get('list',[SurveyController::class,'list']);
        Route::post('add',[SurveyController::class,'add']);
        Route::post('edit',[SurveyController::class,'edit']);
        Route::post('update',[SurveyController::class,'update']);
        Route::post('delete',[SurveyController::class,'delete']);
    });

    Route::group(['prefix' => 'question'],function(){
        Route::get('list',[QuestionController::class,'list']);
        Route::post('add',[QuestionController::class,'add']);
        Route::post('edit',[QuestionController::class,'edit']);
        Route::post('update',[QuestionController::class,'update']);
        Route::post('delete',[QuestionController::class,'delete']);
        Route::post('fetch-question',[QuestionController::class,'fetchQuestion']);
    });

    Route::group(['prefix' => 'answer'],function(){
        Route::post('store',[AnswerController::class,'store']);
    });

    Route::get('logout',[LoginController::class,'logout']);
});