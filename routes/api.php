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

Route::post('login', 'Api\AuthController@login');

Route::get('driver', 'Api\DriverController@index');
Route::get('driver/{id_driver}', 'Api\DriverController@show');
Route::put('driver/{id_driver}', 'Api\DriverController@update');

Route::get('promo', 'Api\PromoController@index');

Route::get('brosur', 'Api\BrosurController@index');

Route::get('pdfPenyewaan/{month}/{year}', 'Api\PdfController@pdfPenyewaan');
Route::get('pdfDetailPendapatan/{month}/{year}', 'Api\PdfController@pdfDetailPendapatan');
Route::get('pdfDriverPerbulan/{month}/{year}', 'Api\PdfController@pdfDriverPerbulan');
Route::get('pdfPerformaDriver/{month}/{year}', 'Api\PdfController@pdfPerformaDriver');
Route::get('pdfCustomer/{month}/{year}', 'Api\PdfController@pdfCustomer');
// Route::group(['middleware' => 'auth:api'], function(){
//     Route::get('logout', 'Api\AuthController@logout');

    

//     Route::get('student', 'Api\StudentController@index');
//     Route::get('student/{id}', 'Api\StudentController@show');
//     Route::post('student', 'Api\StudentController@store');
//     Route::put('student/{id}', 'Api\StudentController@update');
//     Route::delete('student/{id}', 'Api\StudentController@destroy');
// });