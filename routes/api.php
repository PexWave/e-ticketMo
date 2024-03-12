<?php


use App\Http\Controllers\api\OfficeController;
use App\Http\Controllers\api\UserController;
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



//OFFICE ROUTE

Route::apiResource('/office', OfficeController::class);

Route::controller(OfficeController::class)->group(function(){
    Route::post('/office', 'store');
    Route::put('/office/{id}', 'update');
    Route::delete('/office/{id}','destroy');
});

//ROLE ROUTE
Route::apiResource('/role', RoleController::class);
Route::controller(RoleController::class)->group(function() {
    Route::post('/role','store');
    Route::put('/role/{id}','update');
    //specific resource
    Route::get('/role/{id}','show');
});
  
// ROUTES FOR CATEGORIES
Route::apiResource('/extract-categories', CategoriesController::class);
Route::controller(CategoriesController::class)->group(function(){
    Route::post('/add-category', 'store');

    Route::put('/update-category/{id}', 'update');
    Route::get('/get-category/{id}', 'show');
    Route::delete('/delete-category/{id}', 'destroy');
});

// ROUTES FOR USER
Route::apiResource('/user', UserController::class);
Route::controller(UserController::class)->group(function() {
    Route::post('/user','store');
    Route::put('/user/{id}','update');
    Route::delete('/user/{id}', 'destroy');
});




