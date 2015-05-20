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

#users
Route::post('users/register', 'Admin\UserController@save');
#Instructores
Route::get('instructores',['uses' => 'InstructorController@index']); //ya sirve
Route::get('instructores/{id}','InstructorController@show'); //ya sirve (falta integrar informacion adicional)
Route::post('instructores','InstructorController@store'); //ya sirve
Route::put('instructores/{id}','InstructorController@update'); // ya sirve
Route::delete('instructores/{id}','InstructorController@destroy');

#Cursos

Route::get('cursos/proximos',['uses' => 'CursosController@get_proximos']);
Route::get('cursos/proximos/{id}',['uses' => 'CursosController@show_proximo']);