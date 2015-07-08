<?php namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Aplicaciones;

use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Swagger\Annotations as SWG;
use Input;
use Illuminate\Http\Request;
use App\Http\Middleware\OnceAuth;
use Illuminate\Contracts\Auth\Guard;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     swaggerVersion="2.0",
 *     resourcePath="/user",
 *     basePath="http://api.intranet.com"
 * )
 */
class UserController extends ApiGuardController {

	public function __construct(Guard $auth)
	{
		$this->user = $auth;
	}
/**
 *
 * @SWG\Api(
 *   path="/user/register",
 *   description="Referente a los Usuarios",
 *   @SWG\Operation(
*	  method="POST", 
*		summary="Graba un usuario nuevo", 
*		notes="Graba un usuario nuevo en el sistema de la Intranet",
*		type="User", 
*		nickname="userRegister",
*		@SWG\Parameter(
	*		name="name", 
	*		description="nombre del usuario", 
	*		paramType="form", 
	*		required=true, 
	*		allowMultiple=false, 
	*		type="string"
* 		),
	*	@SWG\Parameter(
	*		name="email", 
	*		description="Correo del usuario", 
	*		paramType="form", 
	*		required=true, 
	*		allowMultiple=false, 
	*		type="string"
* 		),
	*	@SWG\Parameter(
	*		name="password", 
	*		description="Contraseña del usuario", 
	*		paramType="form", 
	*		required=true, 
	*		allowMultiple=false, 
	*		type="string"
* 		)
*	)
*)
 */
	public function save(Request $request) {

        $user = new User ();
        $user -> name = $request->name;
        $user -> email = $request->email;
        $user -> password = bcrypt($request->password);
        $user -> save();
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('token'));

    }
/**
 *
 * @SWG\Api(
 *   path="/user/getlogin",
 *   description="Inicio de Sesion de USuarios",
 *   @SWG\Operation(
*     method="POST", 
*       summary="Inicia Sesion un Usuario", 
*       notes="Inicia sesion",
*       type="User", 
*       nickname="userRegister",
*       @SWG\Parameter(
    *       name="email", 
    *       description="Email del usuario", 
    *       paramType="form", 
    *       required=true, 
    *       allowMultiple=false, 
    *       type="string"
*       ),
    *   @SWG\Parameter(
    *       name="password", 
    *       description="Contraseña del usuario", 
    *       paramType="form", 
    *       required=true, 
    *       allowMultiple=false, 
    *       type="string"
*       )
*   )
*)
 */
    public function getlogin(Request $request){
        
        $credentials = Input::only('email', 'password');
        if ( ! $token = JWTAuth::attempt($credentials)) {
            return response()->json(false,401);
        }
        
        return response()->json(compact('token'));
    }

    public function getMyApps(){
    	$user = $this->user->getUser();
    	$user_id = $user->id;
    	$AppsWithDescription = array();
    	$allApps = Aplicaciones::all();
    	foreach ($allApps as $app) {
    		if($user->role_id == 1){ // si es admin todo esta permitodo
    			$AppsWithDescription[$app->Nombre]['ruta'] = $app->controlador;
    			$AppsWithDescription[$app->Nombre]['metodo'] = $app->metodo;
     			$AppsWithDescription[$app->Nombre]['l'] = true;
    			$AppsWithDescription[$app->Nombre]['e'] = true;
    			$AppsWithDescription[$app->Nombre]['b'] = true;
    			$AppsWithDescription[$app->Nombre]['m'] = true;
    		}else{
    			if($app->lectura == 0){
	     			$AppsWithDescription[$app->Nombre]['ruta'] = $app->controlador;
	    			$AppsWithDescription[$app->Nombre]['metodo'] = $app->metodo; 
	    			$AppsWithDescription[$app->Nombre]['l'] = true; 				
    			}
    		}
    	}
    	if($user->role_id == 1){
    		$returnApps = $AppsWithDescription;
    	}else{
    		$AppsWithDescription = array();
    		$myApps = User::with(array('privilegios_aplicaciones'))->find($user_id);
    		foreach ($myApps->privilegios_aplicaciones as $app) {
    			$AppsWithDescription[$app->aplicacion->Nombre]['id'] = $app->aplicacion->id_aplicacion;
    			$AppsWithDescription[$app->aplicacion->Nombre]['ruta'] = $app->aplicacion->controlador;
    			$AppsWithDescription[$app->aplicacion->Nombre]['metodo'] = $app->aplicacion->metodo;
    			switch ($app->tipo_privilegios_id_tipo_privilegio) {
    				case 1:
    					$AppsWithDescription[$app->aplicacion->Nombre]['l'] = true;
    				break;
    				case 2:
    					$AppsWithDescription[$app->aplicacion->Nombre]['e'] = true;
    				break;
    				case 3:
    					$AppsWithDescription[$app->aplicacion->Nombre]['m'] = true;
    				break;
    				case 4:
    					$AppsWithDescription[$app->aplicacion->Nombre]['b'] = true;
    				break;
    				case 5:
    					$AppsWithDescription[$app->aplicacion->Nombre]['l'] = true;
		    			$AppsWithDescription[$app->aplicacion->Nombre]['e'] = true;
		    			$AppsWithDescription[$app->aplicacion->Nombre]['b'] = true;
		    			$AppsWithDescription[$app->aplicacion->Nombre]['m'] = true;
    				break;       				   				
    			}
    		}

			$returnApps = $AppsWithDescription;
    	}

		return $returnApps;
    }

    public function getApps(){
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $apps = $this::getAppsByUser($user);
        return response()->json([
            'msg' => 'Ok',
            'apps' => $apps
        ],200);
    }

     public static function getAppsByUser($user){
        $user_id = $user->id;
        $AppsWithDescription = array();
        $allApps = Aplicaciones::all();
        foreach ($allApps as $app) {
            if($user->role_id == 1){ // si es admin todo esta permitodo
                $AppsWithDescription[$app->Nombre]['ruta'] = $app->controlador;
                $AppsWithDescription[$app->Nombre]['metodo'] = $app->metodo;
                $AppsWithDescription[$app->Nombre]['icono'] = $app->icono;
                $AppsWithDescription[$app->Nombre]['l'] = true;
                $AppsWithDescription[$app->Nombre]['e'] = true;
                $AppsWithDescription[$app->Nombre]['b'] = true;
                $AppsWithDescription[$app->Nombre]['m'] = true;
            }else{
                if($app->lectura == 0){
                    $AppsWithDescription[$app->Nombre]['ruta'] = $app->controlador;
                    $AppsWithDescription[$app->Nombre]['metodo'] = $app->metodo; 
                    $AppsWithDescription[$app->Nombre]['l'] = true;                 
                }
            }
        }
        if($user->role_id == 1){
            $returnApps = $AppsWithDescription;
        }else{
            $AppsWithDescription = array();
            $myApps = User::with(array('privilegios_aplicaciones'))->find($user_id);
            foreach ($myApps->privilegios_aplicaciones as $app) {
                $AppsWithDescription[$app->aplicacion->Nombre]['id'] = $app->aplicacion->id_aplicacion;
                $AppsWithDescription[$app->aplicacion->Nombre]['ruta'] = $app->aplicacion->controlador;
                $AppsWithDescription[$app->aplicacion->Nombre]['metodo'] = $app->aplicacion->metodo;
                switch ($app->tipo_privilegios_id_tipo_privilegio) {
                    case 1:
                        $AppsWithDescription[$app->aplicacion->Nombre]['l'] = true;
                    break;
                    case 2:
                        $AppsWithDescription[$app->aplicacion->Nombre]['e'] = true;
                    break;
                    case 3:
                        $AppsWithDescription[$app->aplicacion->Nombre]['m'] = true;
                    break;
                    case 4:
                        $AppsWithDescription[$app->aplicacion->Nombre]['b'] = true;
                    break;
                    case 5:
                        $AppsWithDescription[$app->aplicacion->Nombre]['l'] = true;
                        $AppsWithDescription[$app->aplicacion->Nombre]['e'] = true;
                        $AppsWithDescription[$app->aplicacion->Nombre]['b'] = true;
                        $AppsWithDescription[$app->aplicacion->Nombre]['m'] = true;
                    break;                                      
                }
            }

            $returnApps = $AppsWithDescription;
        }

        return $returnApps;
    }

    public function getLoginInfo(){
    	return response()->json([
    		'user' => $this->user->getUser(),
    		'apps' => $this->getMyApps()
    		],200);
    }

}