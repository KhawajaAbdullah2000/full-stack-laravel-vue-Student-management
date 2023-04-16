<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/students",[StudentController::class,"index"]);
Route::post("/students",[StudentController::class,"store"]);
Route::get("/students/{id}",[StudentController::class,"show"]);
Route::get("/students/{id}/edit",[StudentController::class,"edit"]);
Route::put("/students/{id}/edit",[StudentController::class,"update"]); //update form
Route::delete("/students/{id}/delete",[StudentController::class,"destroy"]); //update form