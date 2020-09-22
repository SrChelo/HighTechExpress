<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home','HomeController@index');
Route::resource('/usuarios','UserController')->middleware('auth');
Route::resource('/roles', 'RoleController')->middleware('auth');
Route::resource('/envio','EnvioController')->middleware('auth');
Route::get('/envios','SolicitudController@showSome')->name('envios');
Route::get('/admin/envios','SolicitudController@showAll')->name('enviosAdd');
Route::post('/admin/denegar/{id}','SolicitudController@denegar')->name('denegarAdd');
Route::post('/admin/aceptar/{id}','SolicitudController@aceptar')->name('aceptarAdd');
Auth::routes();

