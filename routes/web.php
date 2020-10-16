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
Route::get('/envios/estado/{state}','SolicitudController@showSomeByState')->name('enviosType')->middleware('auth');
Route::get('/admin/envios','SolicitudController@showAll')->name('enviosAdd')->middleware('auth');
Route::get('/admin/envios/pdf','SolicitudController@createPDF1')->name('pdf1')->middleware('auth');
Route::get('/admin/envios/pdf/{state}','SolicitudController@createPDF2')->name('pdf2')->middleware('auth');
Route::get('/repartidor/todas','SolicitudController@showSomeToAdd')->name('enviosToAdd')->middleware('auth');
Route::get('/admin/envios/estado/{state}','SolicitudController@showSomeByStateAdm')->name('enviosAddType')->middleware('auth');
Route::post('/admin/denegar/{id}','SolicitudController@denegar')->name('denegarAdd')->middleware('auth');
Route::post('/admin/aceptar/{id}','SolicitudController@aceptar')->name('aceptarAdd')->middleware('auth');
Route::post('/repartidor/add/{id}','SolicitudController@Add')->name('add')->middleware('auth');
Route::post('/repartidor/end/{id}','SolicitudController@end')->name('end')->middleware('auth');
Route::post('/repartidor/rep/{id}','SolicitudController@rep')->name('rep')->middleware('auth');
Route::get('/repartidor','SolicitudController@showAdded')->name('ruta')->middleware('auth');
Route::get('/registro','UserController@register')->name('registro');

Route::get('/usuario/profile','ProfileController@index')->name('profile')->middleware('auth');
Route::post('/usuario/profile/{id}/upload','ProfileController@update')->name('updateProfile')->middleware('auth');
Auth::routes();


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
