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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['namespace'=>'Access','prefix' => 'users', 'middleware' => ['auth']],function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('role','RoleController@index')->name('role.index')->middleware('permission:role-list|role-create|role-edit|role-delete');
	Route::get('role/create','RoleController@create')->name('role.create');
	Route::post('role','RoleController@store')->name('role.store');
	Route::get('role/{id}/edit','RoleController@edit')->name('role.edit');
	Route::patch('role/{id}','RoleController@update')->name('role.update');
	Route::delete('role/{id}','RoleController@destroy')->name('role.destroy');
});

Route::group(['namespace'=>'Access'],function(){
	Route::resource('permission','PermissionController');
});

Route::resource('user','UserController');
Route::resource('student','StudentController');
