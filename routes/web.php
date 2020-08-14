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

/*Route::get('/', function () {
    
    return view('index', compact('title'));
});*/
Route::get('/', 'Controller@index');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/update', 'DashboardController@update');
Route::get('/datasensor/create', 'DataSensorController@insert');
Auth::routes(['register' => true]); // Deactivate register view.

Route::get('/home', 'Controller@index');

Route::get('/admin/settings', 'AdminController@index');
Route::post('admin/element/update', 'AdminController@update');
