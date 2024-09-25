<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileManagerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/list-files', function () {
//     return view('file-list');
// });


Route::get('/list-files', [FileManagerController::class, 'listFiles']);

Route::get('/grab-csv-files', [FileManagerController::class, 'downloadCSVFiles']);
