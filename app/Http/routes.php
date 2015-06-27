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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

#clients
Route::post('client/register', 'Admin\ClientController@save');
#users
Route::post('user/register', 'Admin\UserController@save');
#Instructores
Route::get('instructores',['uses' => 'InstructorController@index']);
Route::get('instructores/{id}','InstructorController@show'); 
Route::post('instructores','InstructorController@store'); 
Route::put('instructores/{id}','InstructorController@update'); 
Route::delete('instructores/{id}','InstructorController@destroy');
#Curss
Route::get('cursos',['uses' => 'CursosController@index','middleware' => 'auth.basic']);
#Grupos
Route::get('cursos/proximos',['uses' => 'CursosController@get_proximos']);
Route::get('cursos/proximos/{id}',['uses' => 'CursosController@show_proximo']);
Route::get('cursos/corriendo',['uses' => 'CursosController@get_corriendo']);
