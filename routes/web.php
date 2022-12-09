<?php

use Illuminate\Support\Facades\Route;

/* --Inicio-- */
Route::get('/inicio', 'App\Http\Controllers\SessionController@index')->name('inicio')->middleware('guest');

/* --JUGADORES-- */

/* Lista */
Route::get('/jugadores', 'App\Http\Controllers\PlayerController@list')->name('jugadores')->middleware('auth');

/* Crear */
Route::get('/jugadores/nuevo','App\Http\Controllers\PlayerController@create')->name('jugadores/nuevo')->middleware('auth');
Route::post('/jugadores/guardar','App\Http\Controllers\PlayerController@store')->name('jugadores/guardar')->middleware('auth');

/* Eliminar */
Route::get('/jugadores/eliminar','App\Http\Controllers\PlayerController@delete')->name('jugadores/eliminar')->middleware('auth');
Route::post('/jugadores/remover','App\Http\Controllers\PlayerController@remove')->name('jugadores/remover')->middleware('auth');

/* Editar */
Route::get("/jugadores/editar/{id}",'App\Http\Controllers\PlayerController@edit')->name("jugadores/editar/{id}")->middleware('auth');
Route::post('/jugadores/actualizar','App\Http\Controllers\PlayerController@update')->name('jugadores/actualizar')->middleware('auth');



/* --EQUIPOS-- */

/* Lista */
Route::get('/equipos', 'App\Http\Controllers\TeamController@list')->name('equipos')->middleware('auth');


/* Crear */
Route::get('/equipos/nuevo','App\Http\Controllers\TeamController@create')->name('equipos/nuevo')->middleware('auth');
Route::post('/equipos/guardar','App\Http\Controllers\TeamController@store')->name('equipos/guardar')->middleware('auth');

/* Eliminar */
Route::get('/equipos/eliminar','App\Http\Controllers\TeamController@delete')->name('equipos/eliminar')->middleware('auth');
Route::post('/equipos/remover','App\Http\Controllers\TeamController@remove')->name('equipos/remover')->middleware('auth');

/* Editar */
Route::get("/equipos/editar",'App\Http\Controllers\TeamController@edit')->name("equipos/editar")->middleware('auth');
Route::post('/equipos/actualizar','App\Http\Controllers\TeamController@update')->name('equipos/actualizar')->middleware('auth');

/* --PARTIDOS-- */
Route::get('/historial', 'App\Http\Controllers\MatchController@list')->name('historial')->middleware('auth');

Route::get('/partidos/nuevo', 'App\Http\Controllers\MatchController@create')->name('partidos/nuevo')->middleware('auth');
Route::post('/partidos/guardar','App\Http\Controllers\MatchController@store')->name('partidos/guardar')->middleware('auth');

/* Eliminar */
Route::get('/partidos/eliminar','App\Http\Controllers\MatchController@delete')->name('partidos/eliminar')->middleware('auth');
Route::post('/partidos/remover','App\Http\Controllers\MatchController@remove')->name('partidos/remover')->middleware('auth');

Route::get('/partidos/ultimo', 'App\Http\Controllers\MatchController@last_match')->name('partidos/ultimo')->middleware('auth');


/* --USUARIOS-- */


Route::get('/registro','App\Http\Controllers\SessionController@register')->name('registro')->middleware('guest');
Route::post('/registro-verificacion','App\Http\Controllers\UserController@store')->name('registro-verificacion');


Route::get('/ingresar','App\Http\Controllers\SessionController@login')->name('ingresar')->middleware('guest');
Route::post('/ingresar-verificacion','App\Http\Controllers\SessionController@login_verification')->name('ingresar-verificacion');

Route::get('/cerrar-sesion','App\Http\Controllers\SessionController@logout')->name('cerrar-sesion');


Route::get('/usuario/editar', 'App\Http\Controllers\UserController@edit')->name('usuario/editar')->middleware('auth');
Route::post('/usuario/actualizar','App\Http\Controllers\UserController@update')->name('usuario/actualizar')->middleware('auth');

