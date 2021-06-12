<?php

use Illuminate\Support\Facades\Route;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
    return view('Auth/login');
});

Route::resource('votacion/intendente', 'IntendenteController');
Route::resource('votacion/consejal', 'ConsejalController');

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
Route::get('/home', 'HomeController@index')->name('home');

Route::get('pdf/intendente_resumen', 'PDFController@Resumen_General');
Route::get('pdf/intendente_local_resumen', 'PDFController@Resumen_Local');
