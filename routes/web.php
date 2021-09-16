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
Route::get('consulta/ver_padron', 'InicioController@padron_ver')->name('consulta.padron');
Route::get('consulta/padron_cel', 'BuscarController@padron_celular')->name('consulta.padron_celular');
Route::post('consulta/padron_cel', 'BuscarController@padron_celular_store')->name('consulta.padron_celular_store');
Route::resource('consulta/votos_consejal', 'Consulta_ConsejalController')->names('consulta_consejal');
Route::get('consulta/votos_consejal/Acta/{id1}/{id2}', 'Consulta_ConsejalController@Acta')->name('consulta_consejal.acta');;
Route::get('consulta/votos_intendente/Acta/{id1}/{id2}', 'ConsultaController@Acta')->name('consulta_intendente.acta');
Route::get('consulta/referente', 'ConsultaController@referente')->name('consulta.referente');
Route::get('consulta/referente_intendente', 'ConsultaController@referente_intendente')->name('consulta.referente_intendente');
Route::get('consulta/aporedado', 'ConsultaController@aporedado')->name('consulta.aporedado');
Route::put('consulta/aporedado/{id1}', 'ConsultaController@store_aporedado')->name('consulta.store_aporedado');
Route::get('consulta/votos_consejal/{id1}/{id2}/editar', 'Consulta_ConsejalController@editar')->name('consulta_consejal.editar');
Route::get('consulta/votos_consejal/{id1}/{id2}/eliminar', 'Consulta_ConsejalController@eliminar')->name('consulta_consejal.eliminar');
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
Route::get('reportes/consejal_lista', 'ReporteConsejalController@consejal_lista')->name('reportes.consejal_lista');
Route::get('reportes/consejal', 'ReporteConsejalController@consejal')->name('reportes.consejal');
Route::get('reportes/intendente_resumen', 'ReporteConsejalController@general_intendente')->name('reportes.intendente_resumen');
Route::get('reportes/intendente_local', 'ReporteConsejalController@intendente_local')->name('reportes.intendente_local');
Route::get('reportes/intendente_mesa', 'ReporteConsejalController@intendente_mesa')->name('reportes.intendente_mesa');
Route::get('reportes/intendente', 'ReporteConsejalController@intendente')->name('reportes.intendente');
/*******************************************
 *  PDF
 ******************************************/
Route::get('pdf/intendente_resumen', 'PDFController@Resumen_General')->name('intendente_resumen');
Route::get('pdf/intendente_local_resumen/{id}', 'PDFController@Resumen_Local')->name('intendente_local');
Route::get('pdf/intendente_mesa_resumen/{id}', 'PDFController@Resumen_Mesa')->name('intendente_mesa');
Route::get('pdf/intendente/{id}', 'PDFController@Intendente')->name('intendente');
Route::get('pdf/referente/{id}', 'PDFController@referentes')->name('referente_pdf');
Route::get('pdf/electores', 'PDFController@electores')->name('electores');
Route::get('pdf/electores_pdf', 'PDFController@electores_pdf')->name('electores_pdf');
Route::get('pdf/consejal_resumen', 'PDFController@Resumen_General_Consejal')->name('consejal_resumen');
Route::get('pdf/local_consejal/{id}', 'PDFController@Resumen_Local_Consejal')->name('consejal_local');
Route::get('pdf/mesa_consejal/{id}', 'PDFController@Resumen_Mesa_Consejal')->name('consejal_mesa');
Route::get('pdf/consejal/{id}', 'PDFController@Consejal')->name('consejal');
Route::get('pdf/padron/{id}', 'PDFController@padron_persona')->name('persona_padron');
Route::get('pdf/consejal_lista/{id}', 'PDFController@Lista')->name('consejal_lista');
Route::get('pdf/intendente_acta/{id1}/{id2}', 'PDFController@intendente_acta')->name('intendente_acta');
Route::get('pdf/consejal_acta/{id1}/{id2}', 'PDFController@consejal_acta')->name('consejal_acta');
Route::get('pdf/referente_intendente', 'PDFController@referente_intendente')->name('referente_intendente');
Route::get('pdf/referente_inte/{id}', 'PDFController@referentes_inte')->name('referente_inte_pdf');


Route::get('/limpiar', 'LimpiarController@limpiar');

