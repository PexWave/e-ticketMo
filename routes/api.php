<?php


use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\Api\CategoriesController;

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


//ROLE ROUTE
Route::apiResource('/role', RoleController::class);
Route::controller(RoleController::class)->group(function() {
    Route::post('/role','store');
    Route::put('/role/{id}','update');
    //specific resource
    Route::get('/role/{id}','show');

  
// ROUTES FOR CATEGORIES
Route::controller(CategoriesController::class)->group(function(){
    Route::post('/add-category', 'store');

});