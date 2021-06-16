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

Route::resource('consulta/votos_intendente', 'ConsultaController');
Route::resource('consulta/votos_consejal', 'Consulta_ConsejalController');
Route::get('consulta/votos_consejal/Acta/{id}', 'Consulta_ConsejalController@Acta');
Route::get('consulta/votos_intendente/Acta/{id}', 'ConsultaController@Acta');

Route::resource('acceso/usuario', 'acc_UsuarioController');
Route::resource('acceso/reset', 'acc_ResetController');
Route::resource('acceso/auditoria', 'AuditoriaController');

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
Route::get('/home', 'HomeController@index')->name('home');

Route::get('pdf/intendente_resumen', 'PDFController@Resumen_General');
Route::get('pdf/intendente_local_resumen', 'PDFController@Resumen_Local');
Route::get('pdf/intendente_mesa_resumen', 'PDFController@Resumen_Mesa');
Route::get('pdf/intendente/{id}', 'PDFController@Intendente');

Route::get('pdf/consejal_resumen', 'PDFController@Resumen_General_Consejal');
Route::get('pdf/consejal_local_resumen', 'PDFController@Resumen_Local_Consejal');
Route::get('pdf/consejal_mesa_resumen', 'PDFController@Resumen_Mesa_Consejal');
Route::get('pdf/consejal/{id}', 'PDFController@Consejal');
