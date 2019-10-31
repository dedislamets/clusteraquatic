<?php

use Illuminate\Http\Request;

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

Route::post('import', 'DashboardController@import');
Route::get('total_warga', 'DashboardController@total_warga');
Route::get('pie_chart', 'DashboardController@pieChart');
Route::get('iuran_warga', 'DashboardController@dataTransactions');
Route::get('data_rt', 'DashboardController@data_rt');
Route::get('report', 'DashboardController@reportData');
