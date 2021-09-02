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
/********************************************
 *  VOTACION
 ********************************************/
Route::resource('votacion/intendente', 'IntendenteController')->names('intendente');
Route::resource('votacion/consejal', 'ConsejalController')->names('consejal');
Route::get('votacion/mesas/{id}/intendente', 'IntendenteController@getmesas');
Route::get('votacion/mesas/{id}/consejal', 'ConsejalController@getmesas_consejal');
/******************************************
 *  CONSULTA
 ******************************************/
Route::resource('consulta/votos_intendente', 'ConsultaController')->names('consulta_intendente');
Route::get('consulta/votos_intendente/{id1}/{id2}/editar', 'ConsultaController@editar')->name('consulta_intendente.editar');
Route::get('consulta/votos_intendente/{id1}/{id2}/eliminar', 'ConsultaController@eliminar')->name('consulta_intendente.eliminar');
Route::resource('consulta/padron', 'BuscarController')->names('consulta');
Route::resource('consulta/votos_consejal', 'Consulta_ConsejalController');
Route::get('consulta/votos_consejal/Acta/{id1}/{id2}', 'Consulta_ConsejalController@Acta');
Route::get('consulta/votos_intendente/Acta/{id1}/{id2}', 'ConsultaController@Acta')->name('consulta_intendente.acta');
Route::get('consulta/referente', 'ConsultaController@referente')->name('consulta.referente');
Route::get('consulta/aporedado', 'ConsultaController@aporedado')->name('consulta.aporedado');
Route::put('consulta/aporedado/{id1}', 'ConsultaController@store_aporedado')->name('consulta.store_aporedado');
Route::get('consulta/ver_padron', 'InicioController@padron_ver')->name('consulta.padron');
/*****************************************
 *  ACCESO
 *****************************************/
Route::resource('acceso/usuario', 'acc_UsuarioController');
Route::resource('acceso/reset', 'acc_ResetController');
Route::resource('acceso/auditoria', 'AuditoriaController');
/*****************************************
 *  AUTH
 ****************************************/

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
/********************************************************
 *  REPORTES                                            
 * ******************************************************/
Route::get('reportes/consejal_resumen', 'ReporteConsejalController@general_consejal')->name('reportes.consejal_resumen');
Route::get('reportes/consejal_local', 'ReporteConsejalController@consejal_local')->name('reportes.consejal_local');
Route::get('reportes/consejal_mesa', 'ReporteConsejalController@consejal_mesa')->name('reportes.consejal_mesa');
/*******************************************
 *  PDF
 ******************************************/
Route::get('pdf/intendente_resumen', 'PDFController@Resumen_General');
Route::get('pdf/intendente_local_resumen', 'PDFController@Resumen_Local');
Route::get('pdf/intendente_mesa_resumen', 'PDFController@Resumen_Mesa');
Route::get('pdf/intendente/{id}', 'PDFController@Intendente');
Route::get('pdf/referente/{id}', 'PDFController@referentes')->name('referente_pdf');
Route::get('pdf/electores', 'PDFController@electores')->name('electores');
Route::get('pdf/electores_pdf', 'PDFController@electores_pdf')->name('electores_pdf');
Route::get('pdf/consejal_resumen', 'PDFController@Resumen_General_Consejal')->name('consejal_resumen');
Route::get('pdf/local_consejal/{id}', 'PDFController@Resumen_Local_Consejal')->name('consejal_local');
Route::get('pdf/mesa_consejal/{id}', 'PDFController@Resumen_Mesa_Consejal')->name('consejal_mesa');
Route::get('pdf/consejal/{id}', 'PDFController@Consejal');
Route::get('pdf/consejal_lista', 'PDFController@Lista');

Route::get('/limpiar', 'LimpiarController@limpiar');

