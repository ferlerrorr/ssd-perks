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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//!Cron Jobs Endpoints
Route::get('/ssd/sftp/price-job-update', 'App\Http\Controllers\DataCronController@dataPriceUpdate');
Route::get('/ssd/sftp/soap-search', 'App\Http\Controllers\DataCronController@index');

//!Grab Endpoints
Route::get('/ssd/sftp/stock-update', 'App\Http\Controllers\GrabController@grabStockUpdate');
Route::get('/ssd/sftp/grab-cron-update', 'App\Http\Controllers\GrabController@sftpCronCsvUpdater');
Route::get('/ssd/sftp/grab-store-search/{storeId}', 'App\Http\Controllers\GrabController@searchPerStore');
Route::get('/ssd/sftp/grab-sku-pack', 'App\Http\Controllers\GrabController@loadSkutoPack');
Route::get('/ssd/sftp/grab-stores', 'App\Http\Controllers\GrabController@loadStoreMaintenance');
Route::post('/ssd/sftp/grab-add-sku', 'App\Http\Controllers\GrabController@addGrabSku');
Route::get('/ssd/sftp/grab-delete-sku/{SKU_Number}', 'App\Http\Controllers\GrabController@deleteGrabSku');
Route::put('/ssd/sftp/grab-update-sku/{SKU_Number}', 'App\Http\Controllers\GrabController@updateGrabSku');
Route::get('/ssd/sftp/grab-update-store-maintenance/{istore}', 'App\Http\Controllers\GrabController@updateGrabStoreMaintenance');
Route::post('/ssd/sftp/create-grab-store', 'App\Http\Controllers\GrabController@createGrabStore');
Route::get('/ssd/sftp/grab-delete-store-maintenance/{istore}', 'App\Http\Controllers\GrabController@deleteGrabStore');

//!Store Endpoints
//?Grab
Route::get('/ssd/sftp/read-grab-files', 'App\Http\Controllers\GrabController@readfileSFTP');
