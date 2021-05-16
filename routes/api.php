<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DummyApi;
use App\Http\Controllers\MemberController;
use APP\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('dummy-api', [DummyApi::class, 'getDummyApi']);
#get all device and and device data by id
Route::get('device-list/{id?}', [DeviceController::class, 'getDeviceList']);
#post data 
Route::post('device-add', [DeviceController::class, 'addDevice']);
#update data
Route::put('device-update', [DeviceController::class, 'updateDevice']);
#search Device Data on name
Route::get('device-search/{name}', [DeviceController::class, 'searchDevice']);
#delete device data from db
Route::delete('device-delete/{id}', [DeviceController::class, 'deleteDevice']);
#validation on post request
Route::post('device-save', [DeviceController::class, 'validateAndSave']);





#Secure API with laravel-sanctum
// Route::post('/login', [UserController::class, 'index']);
Route::post('/login', 'App\Http\Controllers\UserController@index');

Route::group(['middleware' => 'auth:sanctum'], function () {
    //All secure URL's
    /**Api using resource controller */
    Route::apiResource('member', MemberController::class);
});


Route::post('file-upload',[DeviceController::class,'uploadFile']);
