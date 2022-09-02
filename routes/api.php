<?php

use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// READ
Route::get('/get_all_product', [ProductController::class, 'get_all_product']);
// CREATE
Route::post('/add_product', [ProductController::class, 'add_product']);
// EDIT
Route::get('/get_edit_product/{id}', [ProductController::class, 'get_edit_product']);
// UPDATE
Route::post('/update_product/{id}', [ProductController::class, 'update_product']);
// DELETE
Route::get('/delete_product/{id}', [ProductController::class, 'delete_product']);

