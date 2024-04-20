<?php


use App\Http\Controllers\Api\ExtensionTimeController;
use App\Http\Controllers\Api\OfficeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ClientTypeController;
use App\Http\Controllers\Api\ItStaffController;
use App\Http\Controllers\Api\TaskTypeController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\AssigningTicketController;
use App\Http\Controllers\Api\UserClientController;
use App\Http\Controllers\Api\TransferTicketController;

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

//STAFF CRUD ROUTE
Route::apiResource('/staff', ItStaffController::class);
Route::controller(ItStaffController::class)->group(function(){
    Route::post('/staff', 'store');
    Route::put('/staff/{id}', 'update');
    Route::delete('/staff/{id}','destroy');
});


//OFFICE ROUTE
Route::apiResource('/office', OfficeController::class);
Route::controller(OfficeController::class)->group(function(){
    Route::post('/office', 'store');
    Route::get('/office/{id}', 'show');
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
  
// CATEGORY ROUTE
Route::apiResource('/extract-categories', CategoriesController::class);
Route::controller(CategoriesController::class)->group(function(){
    Route::post('/add-category', 'store');
    Route::put('/update-category/{id}', 'update');
    Route::get('/get-category/{id}', 'show');
    Route::delete('/delete-category/{id}', 'destroy');
});


// CLIENT-TYPE ROUTE
// Route::apiResource('/extract-client-types', ClientTypeController::class);
Route::apiResource('/extract-client-types', ClientTypeController::class);
Route::controller(ClientTypeController::class)->group(function() {
    Route::get('/get-client-types/{office_id}', 'clientTypes');
    Route::post('/add-client-type', 'store');
    Route::put('/update-client-type/{id}', 'update');
    Route::get('/get-client-type/{id}', 'show');
    Route::delete('/delete-client-type/{id}', 'destroy');
});


// ROUTES FOR USER
Route::apiResource('/user', UserController::class);
Route::controller(UserController::class)->group(function() {
    Route::post('/user','store');
    Route::get('/user/{id}','show');
    Route::put('/user/{id}','update');
    Route::delete('/user/{id}', 'destroy');
});

// ROUTES FOR USER
Route::apiResource('/client', UserClientController::class);
Route::controller(UserClientController::class)->group(function() {
    Route::post('/client','store');
    Route::put('/client/{id}','update');
    Route::delete('/client/{id}', 'destroy');
});

// ROUTES FOR TASK
Route::apiResource('/task', TaskTypeController::class);
Route::controller(TaskTypeController::class)->group(function() {
    Route::post('/task','store');
    Route::get('/get-task/{id}','show');
    Route::put('/task/{id}','update');
    Route::delete('/task/{id}', 'destroy');
});


// ROUTES FOR TICKET
Route::apiResource('/extract-tickets', TicketController::class);
Route::controller(TicketController::class)->group(function(){
    Route::post('/add-ticket', 'store');    
    Route::put('/update-ticket/{id}', 'update');
    Route::get('/queue/{ticket_status}', 'queue');
    Route::get('/get-ticket/{id}', 'show');
    Route::delete('/delete-ticket/{id}', 'destroy');
});
//ROUTES FOR ASSIGNING TICKET
Route::controller(AssigningTicketController::class)->group(function(){
    Route::post('/assign-ticket', 'assignTicketToEmployee');    
});



// ROUTES FOR EXTENSION TIME
Route::apiResource('/extract-extension-time-data', ExtensionTimeController::class);
Route::controller(ExtensionTimeController::class)->group(function(){
    Route::post('/add-extension-time/{id}', 'store');
    Route::put('/update-extension-time/{id}', 'update');
    Route::get('/get-extension-time/{id}', 'show');
    Route::delete('/delete-extension-time/{id}', 'destroy');
    Route::post('/request-extension/{ticketID}', 'requestExtension');
    Route::get('/getPending-request-extension', 'getPendingExtensionRequest');
    Route::put('/update-extension-request-status/{id}', 'updateExtensionRequestStatus');
    Route::put('/resolve_ticket/{id}', 'resolvedTicket');
});

//ROUTES FOR TRANSFER OF TICKETS
Route::controller(TransferTicketController::class)->group(function(){
    Route::put('/update-transfer-request-ticket-status/{id}', 'modifytransferTicket');
});

