<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pagos;
use App\User;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Swagger\Annotations as SWG;
use Input;
use Illuminate\Http\Request;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Admin\UserController;
use App\Models\View_resumen_anual_mensual;

/**
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     swaggerVersion="2.0",
 *     resourcePath="/pagos",
 *     basePath="https://api.intranet.com"
 * )
 */
class PagosController extends ApiGuardController {

	private $token;
	private $user;
	private  $application = 'Pagos'; 
	private $apps;
	public function __construct() {
	    parent::__construct();
		$this->token = JWTAuth::getToken();
	    $this->user = JWTAuth::toUser($this->token);
	    $this->apps = UserController::getAppsByUser($this->user);
		$this->beforeFilter(function(){
		    if(!array_key_exists($this->application,$this->apps)){
		    	return response()->json([
		    		'msg' => 'Sin Privilegios Suficientes'
		    	],403);
		    }
		});
	}

/**
 *
 * @SWG\Api(
 *   path="/pagos/getResume",
 *   description="Obtiene resumen de pagos del año por mes y del año anterior",
 *   @SWG\Operation(
*	  method="GET", 
*		summary="Obtiene resumen de pagos del año por mes y del año anterior", 
*		notes="Obtiene resumen de pagos del año por mes y del año anterior",
*		type="Pagos", 
*		nickname="getPagosResume"
* 	)
* )
*/
	public function getResume(){
		$resumen = View_resumen_anual_mensual::get();
		return response()->json([
			'msg'=>'success',
			'resumen' => $resumen
			],200);
	}

}