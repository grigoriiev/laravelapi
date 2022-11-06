<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotebookController;
use App\Http\Controllers\NotebookListController;
use App\Http\Controllers\UpdateImageController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/v1/notebooklist', [NotebookListController::class, 'list']);

Route::post('/v1/notebook/{notebook}', [UpdateImageController::class, 'updateImage']);

Route::resource('/v1/notebook', NotebookController::class)->only([
    'index', 'show', 'store', 'update', 'destroy'
]);
