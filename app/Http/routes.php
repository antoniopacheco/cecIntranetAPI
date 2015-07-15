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

Route::group(['middleware' => 'cors'], function(){
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
      Route::post('user/getlogin',['uses' => 'Admin\UserController@getlogin']);
      Route::get('user/getApps',['uses' => 'Admin\UserController@getApps','middleware' => 'jwt.auth']);
      //Route::get('user/getLogin',['uses' => 'Admin\UserController@getLoginInfo','middleware' => 'auth.basic.once']);


      #Instructores
      Route::get('instructores',['uses' => 'InstructorController@index','middleware' => 'jwt.auth']);
      Route::get('instructores/{id}','InstructorController@show'); 
      Route::post('instructores','InstructorController@store'); 
      Route::put('instructores/{id}','InstructorController@update'); 
      Route::delete('instructores/{id}','InstructorController@destroy');
      #Cursos
      Route::get('cursos',['uses' => 'CursosController@index','middleware' => 'auth.basic.once']);
      Route::get('cursos/getCountByYear',['uses' => 'CursosController@get_total_anual']);
      #Grupos
      Route::get('cursos/proximos',['uses' => 'CursosController@get_proximos']);
      Route::get('cursos/proximos/{id}',['uses' => 'CursosController@show_proximo']);
      Route::get('cursos/corriendo',['uses' => 'CursosController@get_corriendo']);
      #POA
      Route::get('poa/getResume',['uses' => 'PoaController@getResume','middleware' => 'jwt.auth']);
      #Pagos
      Route::get('pagos/getResume',['uses' => 'PagosController@getResume','middleware' => 'jwt.auth']);

      Route::get('/restricted', [
         'middleware' => 'jwt.auth',
         function () {
             $token = JWTAuth::getToken();
             $user = JWTAuth::toUser($token);

             return Response::json([
                 'data' => [
                     'email' => $user->email,
                     'registered_at' => $user->created_at->toDateTimeString()
                 ]
             ]);
         }
      ]);
});