<?php
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

//Route::get('/', function () {
//   $theme = Theme::uses('default')->layout('home');
//   return $theme->scopeWithLayout('homepage')->render();
//});
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', ['as' => 'auth-login', 'uses' => 'Auth\AuthController@doLogin']);
Route::post('auth/login', ['as' => 'auth-login', 'uses' => 'Pln\LoginController@doLogin']);
Route::get('auth/logout', ['as' => 'auth-logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', ['as' => 'auth-register', 'uses' => 'Auth\AuthController@postRegister']);


//
Route::group(['namespace' => 'Pln'], function() {
    Route::get('/', ['as' => 'homepage', 'uses' => 'WebController@login']);
    Route::get('/home', ['as' => 'home-page', 'uses' => 'WebController@home']);
//   Route::post('/do-login', ['as' => 'do-login', 'uses' => 'LoginController@doLogin']);
//   Route::get('/logout', ['as' => 'logout-page', 'uses' => 'LoginController@logout']);
});

//Route::group(['prefix' => 'tasks/', 'namespace' => 'Tasks'], function () {
Route::group(['prefix' => 'tasks/', 'middleware' => ['auth'], 'namespace' => 'Tasks'], function () {
    Route::get('dashboard', ['as' => 'dashboard_page', 'uses' => 'DashboardController@index']);

    Route::get('/', ['as' => 'user_page', 'uses' => 'UsersController@index']);
    Route::post('user/add', 'UsersController@doAdd');
    Route::post('user/edit', 'UsersController@doEdit');
    Route::post('user/delete', 'UsersController@doDelete');

    Route::get('rkau', ['as' => 'rkau_page', 'uses' => 'RkauController@index']);
    Route::get('rkau/initial', ['as' => 'rkau_add', 'uses' => 'RkauController@doInitial']);
    Route::post('rkau/add', ['as' => 'rkau_add', 'uses' => 'RkauController@doAdd']);
    Route::post('rkau/save', ['as' => 'rkau_save', 'uses' => 'RkauController@doSave']);
    Route::get('rkau/detail/{id}', ['as' => 'rkau_detail', 'uses' => 'RkauController@detailById']);
    Route::get('rkau/download', ['as' => 'rkau_down', 'uses' => 'RkauController@getDownload']);
    
    Route::get('penyusutan', ['as' => 'penyusutan_page', 'uses' => 'PenyusutanController@index']);
    Route::get('penyusutan/initial', ['as' => 'penyusutan_add', 'uses' => 'PenyusutanController@doInitial']);
    Route::post('penyusutan/add', ['as' => 'penyusutan_add', 'uses' => 'PenyusutanController@doAdd']);
    Route::post('penyusutan/save', ['as' => 'penyusutan_save', 'uses' => 'PenyusutanController@doSave']);
    Route::get('penyusutan/detail/{id}', ['as' => 'penyusutan_detail', 'uses' => 'PenyusutanController@detailById']);
    Route::get('penyusutan/download', ['as' => 'penyusutan_down', 'uses' => 'PenyusutanController@getDownload']);
});

Route::get('test', function() {
    dd(DB::connection()->getPdo());
});
