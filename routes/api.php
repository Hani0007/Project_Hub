<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('projects', ProjectController::class);

//============================================================================================//
  //                  TASK CRUD Routes
//=============================================================================================//

Route::apiResource('tasks', TaskController::class);


//============================================================================================//
  //                  STATUS CRUD Routes
//=============================================================================================//
Route::apiResource('statuses', StatusController::class);

//============================================================================================//
  //                  COMMENTS CRUD ROUTES
//=============================================================================================//

Route::apiResource('comments', CommentController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
