<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('/', 'HomeController@index')->middleware('auth');

Route::get('inicio', 'InicioController@index');

Route::resource('votacion/intendente', 'IntendenteController')->names('intendente');
Route::resource('votacion/consejal', 'ConsejalController')->names('consejal');

Route::resource('consulta/votos_intendente', 'ConsultaController')->names('consulta_intendente');

Route::resource('consulta/votante', 'BuscarController')->names('consulta');

Route::resource('consulta/votos_consejal', 'Consulta_ConsejalController');
Route::get('consulta/votos_consejal/Acta/{id}', 'Consulta_ConsejalController@Acta');
Route::get('consulta/votos_intendente/Acta/{id}', 'ConsultaController@Acta');

Route::resource('acceso/usuario', 'acc_UsuarioController');
Route::resource('acceso/reset', 'acc_ResetController');
Route::resource('acceso/auditoria', 'AuditoriaController');

// Route::get('mesas/{id}/intendente', 'IntendenteController@getmesas');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('pdf/intendente_resumen', 'PDFController@Resumen_General');
Route::get('pdf/intendente_local_resumen', 'PDFController@Resumen_Local');
Route::get('pdf/intendente_mesa_resumen', 'PDFController@Resumen_Mesa');
Route::get('pdf/intendente/{id}', 'PDFController@Intendente');
Route::get('pdf/electores', 'PDFController@electores')->name('electores');
Route::get('pdf/electores_pdf', 'PDFController@electores_pdf')->name('electores_pdf');


Route::get('pdf/consejal_resumen', 'PDFController@Resumen_General_Consejal');
Route::get('pdf/consejal_local_resumen', 'PDFController@Resumen_Local_Consejal');
Route::get('pdf/consejal_mesa_resumen', 'PDFController@Resumen_Mesa_Consejal');
Route::get('pdf/consejal/{id}', 'PDFController@Consejal');
Route::get('pdf/consejal_lista', 'PDFController@Lista');

Route::get('/limpiar', 'LimpiarController@limpiar');

