<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListUsersController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('list', ListUsersController::class)->except([
    'update'
]);

Route::post('list/update/{id}', [ListUsersController::class, 'update'])->name('lists.update');
Route::get('list/search/{term}', [ListUsersController::class, 'search'])->name('lists.search');
