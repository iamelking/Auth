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
	Route::get('role/create','RoleController@create')->name('role.create')->middleware('permission:role-create');
	Route::post('role','RoleController@store')->name('role.store')->middleware('permission:role-create');
	Route::get('role/{id}/edit','RoleController@edit')->name('role.edit')->middleware('permission:role-edit');
	Route::patch('role/{id}','RoleController@update')->name('role.update')->middleware('permission:role-edit');
	Route::delete('role/{id}','RoleController@destroy')->name('role.destroy')->middleware('permission:role-delete');
});

Route::group(['namespace'=>'Access'],function(){
	Route::resource('permission','PermissionController');
});

Route::resource('user','UserController');
Route::get('student','StudentController@index')->name('student.index')->middleware('permission:student-list|student-create|student-edit|student-delete');
Route::get('student/create','StudentController@create')->name('student.create')->middleware('permission:student-create');
Route::post('student','StudentController@store')->name('student.store')->middleware('permission:student-create');
Route::get('student/{id}/edit','StudentController@edit')->name('student.edit')->middleware('permission:student-edit');
Route::patch('student/{id}','StudentController@update')->name('student.update')->middleware('permission:student-edit');
Route::delete('student/{id}','StudentController@destroy')->name('student.destroy')->middleware('permission:student-delete');
