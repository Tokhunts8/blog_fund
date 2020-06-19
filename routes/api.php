<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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

Route::group(["prefix" => "v1", 'middleware' => 'cors'], function () {
    Route::resource("employee", "Api\EmployeeController");
    Route::resource("task", "Api\TaskController");
    Route::get("progress", "Api\TaskProgressTypesController@index");
});
