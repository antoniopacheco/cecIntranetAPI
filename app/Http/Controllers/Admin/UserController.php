<?php namespace App\Http\Controllers\Admin;

use App\User;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Swagger\Annotations as SWG;
use Input;
use Illuminate\Http\Request;
/**
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     swaggerVersion="2.0",
 *     resourcePath="/user",
 *     basePath="http://api.intranet.com"
 * )
 */
class UserController extends ApiGuardController {
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
    }


}