<?php

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
Auth::routes();

Route::group(['middleware' => 'auth'], function () {




    /*INICIO TARJETAS*/

    route::get('tarjetas', 'TarjetasController@index')->name('tarjetas');
    route::get('tarjetas/gridtarjetas', 'TarjetasController@gridTarjetas')->name('gridtarjetas');
    route::get('tarjetas/crear', 'TarjetasController@viewCrearTarjeta')->name('tarjetas.crear');
    route::post('tarjetas/crear', 'TarjetasController@crearTarjeta')->name('tarjetas.crearp');
    route::get('tarjetas/editar', 'TarjetasController@viewEditarTarjeta')->name('tarjetas.editar');
    route::post('tarjetas/editar/{id}', 'TarjetasController@editarTarjeta')->name('tarjetas.editarp');
    route::get('tarjetas/crearbloque', 'TarjetasController@viewCrearTarjetaBloque')->name('tarjetas.crearbloque');
    route::post('tarjetas/crearbloque', 'TarjetasController@crearTarjetaBloque')->name('tarjetas.crearbloquep');
    //route::get('tarjetas','TarjetasController@index')->name('tarjetas');


    /*FINALIZA TARJETAS*/
    /* INICIA CREACION TARJETAS BONO */
    route::get('creartarjetasBono', 'TarjetasBonoController@viewCrearTarjetaIndividual')->name('creartarjetasBono');
    route::post('bono.crearindividual', 'TarjetasBonoController@CrearTarjetaIndividual')->name('bono.crearindividual');
    route::get('autoCompleNumContrato', 'TarjetasBonoController@autoCompleNumContrato')->name('autoCompleNumContrato');
    route::get('getNombre', 'TarjetasBonoController@getNombre')->name('getNombre');
    route::get('creartarjetasBonoBloque', 'TarjetasBonoController@viewCrearTarjetaBloque')->name('creartarjetasBonoBloque');
    route::post('bono.crearbloque', 'TarjetasBonoController@CrearTarjetaBloque')->name('bono.crearbloque');
    /*FINALIZA CREACION TARJETAS BONO */

    /*INICIA CONSULTA TARJETA BONO*/
    Route::get('tarjetas/bono/consulta', 'TarjetasBonoController@consultaTarjetasBono')->name('consultabono');
    Route::get('tarjetas/bono/gridconsultatarjetabono', 'TarjetasBonoController@gridConsultaTarjetaBono')->name('gridconsultatarjetabono');
    Route::get('tarjetas/bono/editar/{id}', 'TarjetasBonoController@viewEditarBono')->name('bono.editar')->middleware('permissionshinobi:editar.fecha.bono');
    Route::post('tarjetas/bono/editar/{id}', 'TarjetasBonoController@editarBono')->name('bono.editarp')->middleware('permissionshinobi:editar.fecha.bono');
    Route::post('tarjetas/bono/activar', 'TarjetasBonoController@activarTarjetaBono')->name('tarjeta.bono.activar');
    Route::get('tarjetas/bono/consultainteligente','TarjetasBonoController@viewConsultaxContrato')->name('bono.consultaxcontrato');
    Route::post('tarjetas/bono/consultarporcontrato','TarjetasBonoController@ConsultaxContrato')->name('bono.consultaxcontratop');
    Route::post('tarjetas/bono/consultarporempresa','TarjetasBonoController@ConsultaxEmpresa')->name('bono.consultaxempresap');
    Route::post('tarjetas/bono/activarporcontrato','TarjetasBonoController@ActivarxContrato')->name('bono.activarxcontrato');
    /*FINALIZA CONSULTA TARJETA BONO*/



});